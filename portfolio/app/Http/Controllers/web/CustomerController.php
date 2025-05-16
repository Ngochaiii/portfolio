<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $customer = $user->customer;

        return view('source.web.profile.profile', compact('user', 'customer'));
    }

    public function updateProfile(Request $request)
    {
        // Code hiện tại của bạn giữ nguyên
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'tax_code' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
        ]);

        // Cập nhật thông tin user
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        // Cập nhật thông tin customer
        $customer = $user->customer;
        if (!$customer) {
            // Tạo mới nếu chưa có
            $customer = new Customers();
            $customer->user_id = $user->id;
            $customer->company_name = $validated['company_name'] ?? $validated['name'];
            $customer->tax_code = $validated['tax_code'] ?? null;
            $customer->website = $validated['website'] ?? null;
            $customer->status = 'active';
            $customer->source = 'website';
            $customer->save();
        } else {
            // Cập nhật nếu đã có
            $customer->company_name = $validated['company_name'] ?? $validated['name'];
            $customer->tax_code = $validated['tax_code'] ?? null;
            $customer->website = $validated['website'] ?? null;
            $customer->save();
        }

        // Kiểm tra có URL intended không
        if (session()->has('url.intended')) {
            $intended = session('url.intended');
            session()->forget('url.intended');
            return redirect($intended)->with('success', 'Thông tin đã được cập nhật thành công!');
        }

        // Chuyển hướng về trang profile
        return redirect()->route('customer.profile')->with('success', 'Thông tin đã được cập nhật thành công!');
    }

    /**
     * Hiển thị danh sách hóa đơn chưa thanh toán
     */
    public function showInvoices()
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('customer.profile')->with('error', 'Vui lòng cập nhật thông tin khách hàng trước.');
        }

        // Lấy các hóa đơn chưa thanh toán
        $invoices = Invoices::whereHas('order', function ($query) use ($customer) {
            $query->where('customer_id', $customer->id)
                  ->where('status', 'pending'); // Hóa đơn của đơn hàng đang chờ thanh toán
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('source.web.profile.invoices', compact('user', 'customer', 'invoices'));
    }

    /**
     * Hiển thị lịch sử đơn hàng đã thanh toán
     */
    public function showOrders()
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('customer.profile')->with('error', 'Vui lòng cập nhật thông tin khách hàng trước.');
        }

        // Lấy các đơn hàng đã hoàn thành hoặc đang xử lý
        $orders = Orders::where('customer_id', $customer->id)
            ->whereIn('status', ['completed', 'processing']) // Đơn hàng đã xử lý hoặc hoàn thành
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('source.web.profile.orders', compact('user', 'customer', 'orders'));
    }
}
