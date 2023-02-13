<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\SalePaymentController;
use App\Http\Controllers\SaleInvoiceController;

Route::group(['middleware' => 'auth'], function () {

    // Order Management
    Route::resource('order',        OrderController::class);
    Route::resource('order-item',   OrderItemController::class);
    Route::get('order-item/create/{order_id}',    [OrderItemController::class, 'createOrderItem'])->name('order-item.create.order');

    // Sale
    Route::resource('sale',         SaleController::class);
    Route::resource('sale-item',    SaleItemController::class);
    Route::resource('sale-payment', SalePaymentController::class);
    Route::resource('sale-invoice', SaleInvoiceController::class);
    Route::get('sale/{order_id}/create',    [SaleController::class, 'saleOrderCrate'])->name('sale-order-create');
    Route::put('sale/{order_id}/store',     [SaleController::class, 'saleOrderStore'])->name('sale-order-store');
    /*Route::get('sale-invoice',)->name('sale.invoice');*/

});
