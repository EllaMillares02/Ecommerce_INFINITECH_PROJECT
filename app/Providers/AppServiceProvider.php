<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\cart;
use App\Models\wishlist;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            $userId = Auth::id();
            if ($userId) {
                $cartItems = Cart::where('user_id', $userId)->get();
                $cartCount = $cartItems->count();
                $cartTotal = $cartItems->sum('price');
                $newMessagesCount = ChMessage::where('to_id', $userId)
                ->where('seen', 0) 
                ->count();

                $wishlistItems = wishlist::where('user_id', $userId)->get();
                $wishlistCount = $wishlistItems->count();

            } else {
                $cartCount = 0;
                $cartTotal = 0; 
                $wishlistCount = 0;
                $newMessagesCount = 0;
            }
            $view->with([
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'wishlistCount' => $wishlistCount,
                'newMessagesCount' => $newMessagesCount
            ]);
        });
    }
}
