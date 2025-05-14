<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Đảm bảo import User model

class FrontendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            // Lưu URL hiện tại để redirect sau khi đăng nhập
            session()->put('url.intended', url()->current());
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để tiếp tục.');
        }

        $user = Auth::user();

        // Nếu đang truy cập route checkout, kiểm tra thông tin khách hàng
        if ($request->routeIs('checkout.*')) {
            // Kiểm tra thông tin cần thiết cho checkout
            if (empty($user->phone) || empty($user->address)) {
                session()->put('url.intended', url()->current());
                return redirect()->route('customer.profile')->with('message', 'Vui lòng cập nhật thông tin liên hệ để tiếp tục mua hàng.');
            }

            // Kiểm tra customer nếu cần
            $customer = $user->customer;
            if (!$customer) {
                session()->put('url.intended', url()->current());
                return redirect()->route('customer.profile')->with('message', 'Vui lòng cập nhật thông tin khách hàng để tiếp tục mua hàng.');
            }
        }

        return $next($request);
    }
}
