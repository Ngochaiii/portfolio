<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\QuoteEmail;
use App\Models\Cart;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class QuoteController extends Controller
{
    /**
     * Tạo và tải xuống file PDF báo giá
     */
    public function downloadPdf()
    {
        // Lấy giỏ hàng hiện tại
        $cart = $this->getCart();

        // Nếu giỏ hàng trống, chuyển hướng về trang giỏ hàng
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi tạo báo giá.');
        }

        // Tạo tên file
        $fileName = 'bao-gia-' . date('Ymd') . '-' . $cart->id . '.pdf';

        // Tạo PDF và tải xuống
        return $this->generatePdf()->download($fileName);
    }

    /**
     * Gửi email báo giá trực tiếp bằng HTML
     */
    public function sendEmail(Request $request = null)
    {
        // Nếu gửi từ form, lấy email từ request, nếu không dùng email người dùng hiện tại
        $email = $request ? $request->input('email') : Auth::user()->email;
        $message = $request ? $request->input('message', '') : '';

        // Lấy giỏ hàng hiện tại
        $cart = $this->getCart();

        // Nếu giỏ hàng trống, chuyển hướng về trang giỏ hàng
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi gửi báo giá.');
        }

        $user = Auth::user();
        $config = Config::current();
        $quoteNumber = 'QUOTE-' . date('Ymd') . '-' . str_pad($cart->id, 4, '0', STR_PAD_LEFT);
        $quoteDate = Carbon::now()->format('d/m/Y');
        $expireDate = Carbon::now()->addDays(7)->format('d/m/Y');
        $subtotal = $cart->subtotal;
        $total = $subtotal;

        // Tạo PDF
        $pdf = $this->generatePdf();

        try {
            // Tạo danh sách sản phẩm HTML
            $productsHtml = '';
            foreach ($cart->items as $item) {
                $options = json_decode($item->options, true) ?: [];
                $period = $options['period'] ?? 1;
                $domain = $options['domain'] ?? 'N/A'; // Thêm domain
                $productName = $item->product->name ?? 'Sản phẩm';
                $productSubtotal = number_format($item->subtotal, 0, ',', '.') . ' đ';

                // Thêm domain vào HTML nếu sản phẩm là SSL hoặc domain
                $domainInfo = '';
                if ($item->product && ($item->product->type == 'ssl' || $item->product->type == 'domain')) {
                    $domainInfo = "<div><small>Domain: <strong>{$domain}</strong></small></div>";
                }

                $productsHtml .= "
                <tr>
                    <td>
                        {$period} năm {$productName}
                        {$domainInfo}
                    </td>
                    <td>{$productSubtotal}</td>
                </tr>
                ";
            }

            // Tạo nội dung email HTML trực tiếp
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
                        <p>Báo giá #{$quoteNumber}</p>
                    </div>
                    <p>Kính gửi {$user->name},</p>
                    <p>Cảm ơn bạn đã quan tâm đến dịch vụ của chúng tôi. Chúng tôi gửi đến bạn báo giá theo yêu cầu.</p>";

            // Thêm lời nhắn nếu có
            if (!empty($message)) {
                $emailContent .= "
                    <div style='padding: 15px; background-color: #f5f5f5; border-left: 4px solid #007bff; margin-bottom: 20px;'>
                        <p><strong>Lời nhắn:</strong></p>
                        <p>{$message}</p>
                    </div>";
            }

            $emailContent .= "
                    <div style='background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px;'>
                        <p><strong>Ngày tạo báo giá:</strong> {$quoteDate}</p>
                        <p><strong>Ngày hết hạn:</strong> {$expireDate}</p>
                        <p><strong>Mã báo giá:</strong> {$quoteNumber}</p>
                    </div>
                    <div>
                        <h3>Thông tin báo giá</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$productsHtml}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tổng cộng</th>
                                    <th>" . number_format($total, 0, ',', '.') . " đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <p>Vui lòng kiểm tra file PDF đính kèm để xem chi tiết báo giá.</p>
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

            // Gửi email với nội dung HTML trực tiếp thay vì sử dụng view
            Mail::html($emailContent, function ($message) use ($email, $quoteNumber, $config, $pdf) {
                $message->to($email)
                    ->subject('Báo giá #' . $quoteNumber . ' - ' . ($config->company_name ?? 'Công ty chúng tôi'))
                    ->attachData($pdf->output(), 'bao-gia-' . date('Ymd') . '.pdf');
            });

            return back()->with('success', 'Đã gửi báo giá qua email thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi khi gửi email: ' . $e->getMessage());
        }
    }

    /**
     * Tạo PDF để có thể sử dụng ở nhiều phương thức khác nhau
     */
    private function generatePdf()
    {
        // Lấy giỏ hàng hiện tại
        $cart = $this->getCart();

        // Lấy thông tin người dùng
        $user = Auth::user();

        // Lấy cấu hình trang web
        $config = Config::current();

        // Tạo số báo giá
        $quoteNumber = 'QUOTE-' . date('Ymd') . '-' . str_pad($cart->id, 4, '0', STR_PAD_LEFT);

        // Các ngày liên quan
        $quoteDate = Carbon::now()->format('d/m/Y');
        $expireDate = Carbon::now()->addDays(7)->format('d/m/Y');

        // Tính tổng giá trị giỏ hàng
        $subtotal = $cart->subtotal;

        // Bỏ tính VAT, đặt giá trị VAT = 0
        $vatRate = 0;
        $vatAmount = 0;

        // Tổng cộng (không cộng VAT)
        $total = $subtotal;

        // QR code path
        $qrCodePath = $config->company_bank_qr_code ?
            public_path('storage/' . $config->company_bank_qr_code) :
            public_path('images/qr-placeholder.png');

        // Tạo view cho PDF
        $data = compact(
            'cart',
            'user',
            'config',
            'quoteNumber',
            'quoteDate',
            'expireDate',
            'subtotal',
            'vatRate',
            'vatAmount',
            'total',
            'qrCodePath'
        );

        // Thêm logic để hiển thị thông tin domain
        foreach ($cart->items as $item) {
            if ($item->product && ($item->product->type == 'ssl' || $item->product->type == 'domain')) {
                $options = json_decode($item->options, true) ?: [];
                $item->domain = $options['domain'] ?? 'N/A';
            }
        }

        $pdf = PDF::loadView('source.web.quote.pdf', $data);

        // Thiết lập một số tùy chọn cho PDF
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ]);

        return $pdf;
    }

    /**
     * Lấy giỏ hàng hiện tại
     */
    private function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->with('items.product')
                ->first();
        } else {
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)
                ->with('items.product')
                ->first();
        }

        return $cart;
    }
}
