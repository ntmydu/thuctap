<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\LoginAdController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\UesrController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductFeController;
use App\Http\Controllers\Admin\OrderAdController;


use App\Models\Product;
use Illuminate\Support\Facades\Route;



//--Admin--
Route::get('/admin', [LoginAdController::class, 'index'])->name('admin');
Route::post('/admin/login', [LoginAdController::class, 'login'])->name('admin.login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        route::get('dashboard',  [MainController::class, 'index'])->name('admin');
        route::get('statistic',  [MainController::class, 'dashboard']);
        Route::get('/statistics/week', [MainController::class, 'weekStatistics']);
        Route::get('/statistics/today', [MainController::class, 'todayStatistics']);
        Route::get('/statistics/month', [MainController::class, 'monthStatistics']);
        Route::get('/statistics/year', [MainController::class, 'yearStatistics']);


        // --User--
        Route::get('user/add', [UesrController::class, 'create']);
        Route::post('user/add', [UesrController::class, 'store'])->name('user.store');
        Route::get('user/list', [UesrController::class, 'index']);
        Route::get('user/view/{id}', [UesrController::class, 'view'])->name('user.view');
        Route::delete('user/destroy/{id}', [UesrController::class, 'destroy'])->name('user.destroy');
        Route::get('user/edit/{id}', [UesrController::class, 'show'])->name('user.edit');
        Route::post('user/edit/{id}', [UesrController::class, 'update'])->name('user.update');
        Route::get('/user/search', [UesrController::class, 'search'])->name('user.search');

        // --Menu--
        Route::get('menu/add', [MenuController::class, 'create']);
        Route::post('menu/add', [MenuController::class, 'store']);
        Route::get('menu/list', [MenuController::class, 'index']);
        Route::delete('menu/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
        Route::get('menu/edit/{id}', [MenuController::class, 'show'])->name('menu.edit');
        Route::post('menu/edit/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

        // --Product--
        Route::get('product/add', [ProductController::class, 'create']);
        Route::post('product/add', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/list', [ProductController::class, 'index']);
        Route::get('product/edit/{id}', [ProductController::class, 'show'])->name('product.edit');
        Route::get('product/soldout', [ProductController::class, 'showlist'])->name('product.outofstock');
        Route::post('product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
        // --Slider--
        Route::get('/slide/add', [SliderController::class, 'create']);
        Route::post('/slide/add', [SliderController::class, 'store'])->name('slide.store');
        Route::get('/slide/list', [SliderController::class, 'index']);
        Route::get('slide/edit/{id}', [SliderController::class, 'show'])->name('slide.edit');
        Route::post('slide/edit/{id}', [SliderController::class, 'update'])->name('slide.update');
        Route::DELETE('/slide/destroy/{id}', [SliderController::class, 'destroy'])->name('slide.destroy');

        // --Order--
        Route::get('/order/list', [OrderAdController::class, 'index']);
        Route::get('/order/detail/{id}', [OrderAdController::class, 'view'])->name('order.detail');
        Route::post('/update/status/order/{id}', [OrderAdController::class, 'update'])->name('admin.orders.update');
        Route::get('/order/search', [OrderAdController::class, 'search'])->name('order.search');
        Route::get('/return/order', [OrderAdController::class, 'showreturn']);
        Route::get('/return/detail/{id}', [OrderAdController::class, 'viewReturn'])->name('return.detail');
        Route::post('/update/status/return/{id}', [OrderAdController::class, 'edit'])->name('admin.return.edit');

        // --Discount--
        Route::get('discount/add', [DiscountController::class, 'create']);
        Route::post('discount/add', [DiscountController::class, 'store'])->name('discount.store');
        Route::get('discount/list', [DiscountController::class, 'index'])->name('discount.list');
        Route::get('discount/edit/{id}', [DiscountController::class, 'show'])->name('discount.edit');
        Route::post('discount/edit/{id}', [DiscountController::class, 'update'])->name('discount.update');
        Route::DELETE('discount/destroy/{id}', [DiscountController::class, 'destroy'])->name('discount.destroy');
        Route::get('/discount/search', [DiscountController::class, 'search'])->name('discount.search');
        Route::post('/send/code/discount/{id}', [DiscountController::class, 'send'])->name('send.code');

        Route::get('/logout', [LoginAdController::class, 'logout'])->name('admin.logout');

        Route::get('blog/add', [BlogController::class, 'create']);
        Route::post('blog/add', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog/list', [BlogController::class, 'index'])->name('blog.list');
        Route::get('blog/edit/{id}', [BlogController::class, 'show'])->name('blog.edit');
        Route::post('blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::DELETE('blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
        Route::get('add', [TestController::class, 'create']);
        Route::post('add', [TestController::class, 'store'])->name('add');
    });
});





//--fontend--

//Users

Route::get('/regis', [UesrController::class, 'formregis']);
Route::post('/regis', [UesrController::class, 'regis'])->name('regis');
Route::get('/login', [UesrController::class, 'showlogin'])->name('view.login');
Route::post('/login', [UesrController::class, 'login'])->name('login');
Route::get('/logout', [UesrController::class, 'logout'])->name('logout');
Route::get('/user/profile', [UesrController::class, 'showInfo']);
Route::get('/user/changepass', [UesrController::class, 'showChangePass'])->name('user.changepass');
Route::post('/user/changepass', [UesrController::class, 'changePass'])->name('pass.change');

// --Cart--
Route::post('/add/cart', [CartController::class, 'create'])->name('cart.add');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/minus/{id}', [CartController::class, 'minusQuantity'])->name('cart.minus');
Route::get('/cart/plus/{id}', [CartController::class, 'plusQuantity'])->name('cart.plus');
Route::delete('/destroy/cart/{id}', [CartController::class, 'delete'])->name('cart.destroy');


//--homepage--
Route::get('/', [HomeController::class, 'index']);
Route::get('/product/search', [HomeController::class, 'search'])->name('search');
Route::get('test/mail', [HomeController::class, 'testMail']);
Route::get('/forget/password', [HomeController::class, 'show']);
Route::post('send/request', [HomeController::class, 'request'])->name('send.request');
Route::get('view/recover', [HomeController::class, 'showview'])->name('view.recover');
Route::post('recover/password', [HomeController::class, 'recover'])->name('recover.password');
Route::get('newpass', [HomeController::class, 'newpass'])->name('new.pass');
Route::post('new/pass', [HomeController::class, 'updatepass'])->name('new.password');
Route::get('/blog/{id}', [HomeController::class, 'showBlog'])->name('blog.detail');

// --Product--
Route::get('/product/detail/{order}', [ProductFeController::class, 'index'])->name('product.detail');
Route::get('/product/list/{id}', [ProductFeController::class, 'show'])->name('product.list');
Route::get('/product/list', [ProductFeController::class, 'showAll'])->name('product.all');
// đánh giá sản phẩm
Route::get('/review/{id}', [ProductFeController::class, 'showReview'])->name('view.review');
Route::post('product/review', [ProductFeController::class, 'addReview'])->name('product.review');
//--
Route::get('/product/filterLow', [ProductFeController::class, 'filterLow'])->name('product.filterLow');
Route::get('/product/filterAverage', [ProductFeController::class, 'filterAverageer'])->name('product.filterAverage');
Route::get('/product/filterHigh', [ProductFeController::class, 'filterHigh'])->name('product.filterHigh');
Route::get('/product/filterHigher', [ProductFeController::class, 'filterHigher'])->name('product.filterHigher');

//--Order--
Route::post('/order/confirm', [OrderController::class, 'showconfirm'])->name('order.confirm');
Route::get('/order/review', [OrderController::class, 'reviewOrder'])->name('order.review');
Route::POST('/order', [OrderController::class, 'index'])->name('order');

Route::post('/applyDiscount', [OrderController::class, 'applydiscount'])->name('discount.apply');
Route::post('/add/order', [OrderController::class, 'create'])->name('order.add');
Route::get('order/management', [OrderController::class, 'showlistOd'])->name('order.management');
Route::get('order/pending', [OrderController::class, 'listOrdpending'])->name('order.pending');
Route::get('order/delivered', [OrderController::class, 'listOrddelivered'])->name('order.delivered');
Route::get('order/cancelled', [OrderController::class, 'listOrdCancelled'])->name('order.cancelled');
Route::get('order/pending', [OrderController::class, 'listOrdpending'])->name('order.pending');
Route::post('cancel/order/{id}', [OrderController::class, 'cancelOrd'])->name('cancel.order');
Route::get('request/return/order/{id}', [OrderController::class, 'request'])->name('request.view');
Route::post('request/return', [OrderController::class, 'return'])->name('request.return');