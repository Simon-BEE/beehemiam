<?php

use App\Http\Controllers\Api\Cart\AddCartController;
use App\Http\Controllers\Api\Cart\ApiCouponController;
use App\Http\Controllers\Api\Cart\RemoveCartController;
use App\Http\Controllers\Api\Cart\UpdateCartController;
use App\Http\Controllers\Api\Order\RegisterOrderController;
use App\Http\Controllers\Api\Payments\PaymentIntentController;
use App\Http\Controllers\Api\Products\ProductAvailabilityController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Shop\Cart\AddressCartController;
use App\Http\Controllers\Shop\Cart\IndexCartController;
use App\Http\Controllers\Shop\Order\GuestOrderController;
use App\Http\Controllers\Shop\Order\IndexOrderController;
use App\Http\Controllers\WelcomeController;
use App\Mail\Orders\OrderSummaryMail;
use App\Models\Order;
use App\Services\InvoiceGeneratorService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $order = Order::first();
    return view('pdf.invoice', [
        'order' => $order,
        'address' => $order->invoice->address,
        'reference' => $order->invoice->reference
    ]);
    $pdf = new InvoiceGeneratorService($order, $order->invoice->address);
    // $pdf->generate()->save();
    return $pdf->generate()->stream();
});

/**
 * Api routes
*/
Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    /**
     * Cart api routes
     */
    Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
        Route::post('/add/sizes/{productOptionSize}', [AddCartController::class, 'addOrder'])->name('add.sizes');
        Route::patch('/update/sizes/{productOptionSize}', [UpdateCartController::class, 'updateOrder'])
            ->name('update.sizes');
        Route::delete('/delete/sizes/{productOptionSize}', [RemoveCartController::class, 'deleteOrder'])
            ->name('delete.sizes');

        Route::post('/add/preorder', [AddCartController::class, 'addPreOrder'])->name('add.preorder');
        Route::patch('/update/preorder', [UpdateCartController::class, 'updatePreOrder'])
            ->name('update.preorder');
        Route::patch('/delete/preorder', [RemoveCartController::class, 'deletePreOrder'])
            ->name('delete.preorder');

        Route::post('/coupons/add', ApiCouponController::class)->name('coupons.add');
    });

    /**
     * Product availability api routes
     */
    Route::post('/products/{productOption}/notify-availability', ProductAvailabilityController::class)
        ->name('products.notify-availability');

    /**
     * Payment and order api routes
     */
    Route::get('/payments/stripe/payment-intent', PaymentIntentController::class)
        ->name('payments.stripe.payment-intent');

    Route::post('/orders', RegisterOrderController::class)
        ->name('orders.store');
});

Route::group(['prefix' => 'panier', 'as' => 'cart.'], function () {

    Route::get('/', IndexCartController::class)->name('index');

    Route::get('/livraisons', [AddressCartController::class, 'index'])->name('shippings.index');
    Route::post('/livraisons', [AddressCartController::class, 'store'])->name('shippings.store');

    Route::get('/validation', IndexOrderController::class)->name('orders.index');
});

/**
 * Guest order routes
 */
Route::group(['as' => 'guest.'], function () {
    Route::get('commandes/{hashedOrderId}', [GuestOrderController::class, 'show'])->name('orders.show');
    Route::get('commandes/{hashedOrderId}/facture', [GuestOrderController::class, 'invoice'])->name('orders.invoice');
});

/**
 * Website simple pages
 */
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/conditions-generales-d-utilisation', [PageController::class, 'showTermsAndConditions'])->name('pages.terms-conditions');
Route::get('/politique-de-confidentialite', [PageController::class, 'showPrivacyPolicy'])->name('pages.privacy-policy');

/**
 * Homepage
 */
Route::get('/', WelcomeController::class)->name('welcome');

Route::personalDataExports('personal-data-exports');

require __DIR__.'/auth.php';
