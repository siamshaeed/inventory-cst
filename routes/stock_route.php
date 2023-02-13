<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\PurchaseDueController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;

Route::group(['middleware' => 'auth'], function () {

    // Stock Management
    Route::resource('purchase',         PurchaseController::class);
    Route::resource('purchase-item',    PurchaseItemController::class);
    Route::resource('purchase-due',     PurchaseDueController::class);
    Route::resource('stock',            StockController::class);
    Route::resource('expense',          ExpenseController::class);
    Route::resource('expense-category', ExpenseCategoryController::class);
    Route::get('purchase-due/pay/{purchase_id}',  [PurchaseDueController::class, 'purchaseDuePay'])->name('purchase-due.pay');

});
