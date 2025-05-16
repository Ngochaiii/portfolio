<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          // Chia sẻ số lượng sản phẩm trong giỏ hàng với tất cả view
        View::composer('*', function ($view) {
            if (!session()->has('cart_count')) {
                $cart = null;

                if (Auth::check()) {
                    $cart = Cart::where('user_id', Auth::id())->first();
                } else {
                    $sessionId = session()->getId();
                    $cart = Cart::where('session_id', $sessionId)->first();
                }

                $cartCount = 0;
                if ($cart) {
                    $cartCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
                }

                session(['cart_count' => $cartCount]);
            }

            $view->with('cart_count', session('cart_count', 0));
        });
    }
}
