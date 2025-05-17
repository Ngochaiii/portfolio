<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Invoices;
use App\Models\Orders;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Config;

class PaymentController extends Controller
{
    /**
     * Hiển thị danh sách yêu cầu thanh toán
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $payments = Payments::with(['invoice', 'order.customer.user'])
            ->when($status, function ($query, $status) {
                if ($status !== 'all') {
                    return $query->where('status', $status);
                }
            })
            ->latest()
            ->paginate(10);

        $counts = [
            'all' => Payments::count(),
            'pending' => Payments::where('status', 'pending')->count(),
            'completed' => Payments::where('status', 'completed')->count(),
            'failed' => Payments::where('status', 'failed')->count(),
        ];

        // Thêm dữ liệu thống kê
        $stats = [
            'today_payments' => Payments::whereDate('created_at', Carbon::today())
                ->where('status', 'completed')
                ->sum('amount'),
            'total_completed' => Payments::where('status', 'completed')->sum('amount'),
            'total_pending' => Payments::where('status', 'pending')->sum('amount'),
        ];

        return view('source.admin.payments.index', compact('payments', 'status', 'counts', 'stats'));
    }

    /**
     * Xác nhận thanh toán
     */
    public function approve(Request $request, $id)
    {
        $payment = Payments::with(['invoice', 'order.customer.user'])->findOrFail($id);

        // Kiểm tra trạng thái
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Thanh toán này đã được xử lý trước đó.');
        }

        // Cập nhật trạng thái thanh toán
        $payment->status = 'completed';
        $payment->save();

        // Cập nhật trạng thái hóa đơn
        $invoice = $payment->invoice;
        $invoice->status = 'paid';
        $invoice->save();

        // Cập nhật trạng thái đơn hàng
        $order = $payment->order;
        $order->status = 'completed'; // Thay 'processing' thành 'completed'
        $order->save();

        // Gửi email thông báo cho khách hàng (nếu cần)
        if ($order->customer && $order->customer->user && $order->customer->user->email) {
            try {
                $this->sendPaymentApprovedEmail($order->customer->user, $payment);
            } catch (\Exception $e) {
                Log::error('Lỗi gửi email xác nhận thanh toán: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Thanh toán đã được xác nhận và đơn hàng đã hoàn thành.');
    }

    /**
     * Từ chối thanh toán
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $payment = Payments::with(['invoice', 'order.customer.user'])->findOrFail($id);

        // Kiểm tra trạng thái
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Thanh toán này đã được xử lý trước đó.');
        }

        // Cập nhật trạng thái thanh toán
        $payment->status = 'failed';
        // Bỏ dòng gán verified_by và verified_at
        $payment->notes = 'Từ chối: ' . $request->reason;
        $payment->save();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Thanh toán đã bị từ chối.');
    }

    /**
     * Gửi email thông báo thanh toán đã được xác nhận
     */
    private function sendPaymentApprovedEmail($user, $payment)
    {
        // Lấy thông tin cấu hình
        $config = Config::current();

        // Lấy thời gian xác nhận, nếu không có thì dùng thời gian hiện tại
        $verifiedDate = $payment->verified_at ? $payment->verified_at->format('d/m/Y H:i:s') : now()->format('d/m/Y H:i:s');

        // Tạo nội dung email
        $emailContent = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
            .header h1 { margin: 0; color: #333; font-size: 24px; }
            .success-box { background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
            th { font-weight: bold; }
            .footer { margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px; font-size: 12px; color: #777; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>" . ($config->company_name ?? 'Hostist company') . "</h1>
                <p>Xác nhận thanh toán</p>
            </div>

            <div class='success-box'>
                <p><strong>Thanh toán của bạn đã được xác nhận!</strong> Cảm ơn bạn đã thanh toán.</p>
            </div>

            <p>Kính gửi {$user->name},</p>

            <p>Chúng tôi xác nhận đã nhận được thanh toán của bạn với thông tin như sau:</p>

            <table>
                <tr>
                    <th>Mã hóa đơn:</th>
                    <td>{$payment->invoice->invoice_number}</td>
                </tr>
                <tr>
                    <th>Mã đơn hàng:</th>
                    <td>{$payment->order->order_number}</td>
                </tr>
                <tr>
                    <th>Số tiền:</th>
                    <td>" . number_format($payment->amount, 0, ',', '.') . " đ</td>
                </tr>
                <tr>
                    <th>Phương thức:</th>
                    <td>Chuyển khoản ngân hàng</td>
                </tr>
                <tr>
                    <th>Ngày xác nhận:</th>
                    <td>{$verifiedDate}</td>
                </tr>
                <tr>
                    <th>Mã giao dịch:</th>
                    <td>{$payment->transaction_id}</td>
                </tr>
            </table>

            <p>Đơn hàng của bạn đang được xử lý. Bạn có thể theo dõi tình trạng đơn hàng tại
            <a href='" . route('customer.orders') . "'>Trang quản lý đơn hàng</a>.</p>

            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email " .
            ($config->support_email ?? 'supposthostit@gmail.com') . " hoặc số điện thoại " .
            ($config->support_phone ?? 'N/A') . ".</p>

            <p>Trân trọng,<br>
            " . ($config->company_name ?? 'Hostist company') . "</p>

            <div class='footer'>
                <p>© " . date('Y') . " " . ($config->company_name ?? 'Hostist company') . ". Tất cả các quyền được bảo lưu.</p>
            </div>
        </div>
    </body>
    </html>
    ";

        // Gửi email
        Mail::html($emailContent, function ($mail) use ($user, $payment) {
            $mail->to($user->email)
                ->subject('Xác nhận thanh toán hóa đơn #' . $payment->invoice->invoice_number);
        });
    }
}
