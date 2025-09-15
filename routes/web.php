<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products\ProductPage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', Dashboard::class);
Route::get('/admin/products', ProductPage::class);