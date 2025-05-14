<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customers;
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

        // Chuyển hướng đến trang chủ
        return redirect()->route('homepage')->with('success', 'Thông tin đã được cập nhật thành công!');
    }
}
