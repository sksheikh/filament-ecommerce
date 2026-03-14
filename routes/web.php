<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\HomePage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductsPage;
use App\Livewire\CategoriesPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/categories ', CategoriesPage::class);
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{slug}', ProductDetailPage::class);
Route::get('/cart', CartPage::class);




Route::middleware(['guest:customer'])->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/logout', function () {
        auth('customer')->logout();
        return redirect('/');
    })->name('logout');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/checkout/payment/{order}', \App\Livewire\BkashPaymentPage::class)->name('checkout.payment');
    Route::get('/profile', \App\Livewire\ProfilePage::class)->name('profile');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order}', MyOrderDetailPage::class);

    Route::get('/success/{order}',  SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/orders/{order}/invoice', [App\Http\Controllers\OrderPrintController::class, 'invoice'])->name('admin.orders.invoice');
    Route::get('/admin/orders/{order}/delivery-slip', [App\Http\Controllers\OrderPrintController::class, 'deliverySlip'])->name('admin.orders.delivery-slip');
});
