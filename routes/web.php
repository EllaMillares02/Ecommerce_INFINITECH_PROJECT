<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\ChatifyController;
use App\Http\Controllers\GoogleController;


route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googleCallback']);

route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
route::get('/view_category',[AdminController::class,'view_category'])->name('view_category');
route::post('/add_category',[AdminController::class,'add_category']);
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
route::get('/view_product',[AdminController::class,'view_product']);
route::post('/add_product',[AdminController::class,'add_product']);
route::get('/show_product',[AdminController::class,'show_product'])->name('show_product');;
route::get('/delete_product/{id}',[AdminController::class,'delete_product'])->name('delete_product');
route::get('/update_product/{id}',[AdminController::class,'update_product']);

Route::put('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');

route::get('/view_order',[AdminController::class,'view_order'])->name('view_order');
route::get('/accepted/{id}',[AdminController::class,'accepted']);
Route::post('/toDeliver/{id}', [AdminController::class, 'toDeliver'])->name('toDeliver');
route::get('/sale',[AdminController::class,'sale'])->name('sale');
route::post('/add_sale',[AdminController::class,'add_sale']);
route::get('/view_sale',[AdminController::class,'view_sale']);
route::get('/delete_sale/{id}',[AdminController::class,'delete_sale'])->name('delete_sale');
route::get('/update_sale/{id}',[AdminController::class,'update_sale']);
route::post('/update_sale_confirm/{id}',[AdminController::class,'update_sale_confirm']);
route::get('/update_category/{id}',[AdminController::class,'update_category']);
route::post('/update_category_confirm/{id}',[AdminController::class,'update_category_confirm']);
route::get('/view_coupons',[AdminController::class,'view_coupons'])->name('view_coupons');
route::post('/add_coupon',[AdminController::class,'add_coupon']);
route::get('/update_coupon/{id}',[AdminController::class,'update_coupon']);
route::post('/update_coupon_confirm/{id}',[AdminController::class,'update_coupon_confirm']);
route::get('/delete_coupon/{id}',[AdminController::class,'delete_coupon']);
route::get('/view_inventory',[AdminController::class,'view_inventory']);
Route::get('/get-weekly-sales-data', [AdminController::class, 'getWeeklySalesData']);
Route::post('/view_order/cancel/{id}', [AdminController::class, 'cancelOrder'])->name('view_order.cancel');
route::get('/outOfStock_product',[AdminController::class,'outOfStock_product'])->name('outOfStock_product');;
Route::get('/changeBanner', [AdminController::class, 'changeBanner'])->name('changeBanner');
Route::post('/changeBanner/{id}', [AdminController::class, 'updateBanner'])->name('admin.updateBanner');
Route::get('/manage_blogs', [AdminController::class, 'manage_blogs'])->name('manage_blogs');
Route::get('/add_blogs', [AdminController::class, 'add_blogs'])->name('add_blogs');
Route::post('/save_blog', [AdminController::class, 'save_blog'])->name('save_blog');
Route::get('/update_blog/{id}', [AdminController::class, 'update_blog'])->name('update_blog');
Route::post('/update_blog_confirm/{id}',[AdminController::class,'update_blog_confirm']);
route::get('/delete_blog/{id}',[AdminController::class,'delete_blog']);
Route::get('/admin/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');

Route::get('/addAdmin', [AdminController::class, 'addAdmin'])->name('addAdmin');
Route::post('/addAdmin', [AdminController::class, 'store'])->name('admin.store');

route::get('/updateAdminAcc/{id}',[AdminController::class,'updateAdminAcc']);
route::post('/updateAdminAcc_confirm/{id}',[AdminController::class,'updateAdminAcc_confirm']);
route::get('/delete_user/{id}',[AdminController::class,'delete_user']);

route::get('/login_page',[HomeController::class,'login_page'])->name('login_page');
route::get('/register_page',[HomeController::class,'register_page'])->name('register_page');
route::get('/product_details/{id}',[HomeController::class,'product_details']);
route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
Route::post('/update_cart', [HomeController::class, 'update_cart']);
route::post('/add_wishlist/{id}',[HomeController::class,'add_wishlist']);
route::get('/show_wishlist',[HomeController::class,'show_wishlist']);
route::get('/remove_wishlist/{id}',[HomeController::class,'remove_wishlist'])->name('remove_wishlist');

route::post('/checkout',[HomeController::class,'checkout']);
route::get('/orders',[HomeController::class,'orders'])->name('orders');;
route::post('/save_orders',[HomeController::class,'save_orders']);
route::get('/show_shop',[HomeController::class,'show_shop'])->name('show_shop');

Route::post('/validate-coupon', [HomeController::class, 'validateCoupon'])->name('validate.coupon');
Route::post('/orders/cancel/{id}', [HomeController::class, 'cancelOrder'])->name('orders.cancel');
Route::get('/orders/received/{id}', [HomeController::class, 'received'])->name('order.received');
route::get('/e_receipt/{id}',[HomeController::class,'e_receipt']);
route::get('/blogs',[HomeController::class,'blogs']);
route::get('/blog_details/{id}',[HomeController::class,'blog_details'])->name('blog_details');

route::get('/rate_now/{id}',[HomeController::class,'rate_now']);
Route::post('/submit-reviews', [HomeController::class, 'submitReviews'])->name('submit.reviews');
route::get('/contact',[HomeController::class,'contact']);
// routes/web.php
Route::get('/search_page', [HomeController::class, 'search_page'])->name('search_page');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');
route::get('/show_profile',[HomeController::class,'show_profile'])->name('show_profile');;
route::get('/show_faqs',[HomeController::class,'show_faqs'])->name('show_faqs');;
Route::get('/complete-profile', [HomeController::class, 'completeProfile'])->name('complete_profile')->middleware('auth');
Route::post('/save-profile', [HomeController::class, 'saveProfile'])->name('saveProfile');
Route::get('/userpage', [HomeController::class, 'userProfile'])->name('home.userpage');
Route::post('/contact', [HomeController::class, 'send'])->name('contact.send');
Route::post('/show_faqs', [HomeController::class, 'send'])->name('contact.send');


route::get('/order_details/{id}',[DeliveryManController::class,'order_details']);
Route::get('/home', [DeliveryManController::class, 'showDashboard'])->name('showDashboard');
route::get('/deliveries',[DeliveryManController::class,'deliveries']);
Route::post('/uploadProof/{id}', [DeliveryManController::class, 'uploadProof']);
Route::post('/order_details/cancel/{id}', [DeliveryManController::class, 'cancelOrder'])->name('order_details.cancel');
Route::get('/get-rider-location', [DeliveryManController::class, 'getLocation']);
