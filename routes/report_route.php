<?php

use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\SaleReportController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\ReportDownloadController;
use App\Http\Controllers\ExpenseExportController;

Route::group(['middleware' => 'auth'], function () {

    // Report Management
    Route::prefix('report')->group(function () {
        Route::prefix('purchase')->group(function () {
            Route::get('customer',          [PurchaseReportController::class, 'customer'])->name('report.purchase.customer');
            Route::get('customer/{slug}',   [PurchaseReportController::class, 'customerSlug'])->name('report.purchase.customerSlug');
            Route::get('single-product',    [PurchaseReportController::class, 'singleProduct'])->name('report.purchase.singleProduct');
        });

        Route::prefix('order')->group(function () {
            Route::get('customer',  [OrderReportController::class, 'customer'])->name('report.order.customer');
        });

        Route::prefix('sale')->group(function () {
            Route::get('customer',          [SaleReportController::class, 'customer'])->name('report.sale.customer');
            Route::get('customer/{slug}',   [SaleReportController::class, 'customerSlug'])->name('report.sale.customerSlug');
            Route::get('profit-loss',       [SaleReportController::class, 'profitLoss'])->name('report.sale.profitLoss');
        });

        Route::get('expense',   [ExpenseReportController::class, 'expense'])->name('report.expense');

        Route::get('export', [ExpenseExportController::class, 'export']);
    });

});

//test
