<?php

use Illuminate\Support\Facades\Route;

// Import untuk Admin
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products\ProductPage;
use App\Livewire\Admin\Orders\OrderPage;
use App\Livewire\Admin\Finance\FinancePage;
use App\Livewire\Admin\Sliders\SliderPage;

// ===============================================
// 1. Import komponen HomePage untuk halaman publik
use App\Livewire\Public\HomePage;
// ===============================================


// ===============================================
// 2. Ganti route '/' yang lama
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// 3. Arahkan route '/' ke HomePage
Route::get('/', HomePage::class);
// ===============================================


// Route untuk Panel Admin
Route::get('/admin/dashboard', Dashboard::class);
Route::get('/admin/products', ProductPage::class);
Route::get('/admin/orders', OrderPage::class);
Route::get('/admin/finance', FinancePage::class);
Route::get('/admin/sliders', SliderPage::class); 