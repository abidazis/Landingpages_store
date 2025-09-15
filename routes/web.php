<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products\ProductPage;
use App\Livewire\Admin\Orders\OrderPage;
use App\Livewire\Admin\Finance\FinancePage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', Dashboard::class);
Route::get('/admin/products', ProductPage::class);
Route::get('/admin/orders', OrderPage::class);
Route::get('/admin/finance', FinancePage::class);