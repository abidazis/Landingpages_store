<?php

use Illuminate\Support\Facades\Route;

// == BAGIAN 1: RUTE PUBLIK (BISA DIAKSES SEMUA ORANG) ==
// Import komponen untuk halaman publik
use App\Livewire\Public\HomePage;
use App\Livewire\Public\CatalogPage;
use App\Livewire\Public\ProductDetailPage;

Route::get('/', HomePage::class);
Route::get('/katalog', CatalogPage::class);
Route::get('/produk/{product:slug}', ProductDetailPage::class);


// == BAGIAN 2: RUTE ADMIN (WAJIB LOGIN) ==
// Import komponen untuk halaman admin
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products\ProductPage;
use App\Livewire\Admin\Orders\OrderPage;
use App\Livewire\Admin\Finance\FinancePage;
use App\Livewire\Admin\Sliders\SliderPage;

// Semua route di dalam grup ini akan otomatis dilindungi oleh middleware 'auth'
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/products', ProductPage::class)->name('admin.products');
    Route::get('/orders', OrderPage::class)->name('admin.orders');
    Route::get('/finance', FinancePage::class)->name('admin.finance');
    Route::get('/sliders', SliderPage::class)->name('admin.sliders');
});


// == BAGIAN 3: RUTE OTENTIKASI (LOGIN, REGISTER, DLL) ==
// Biarkan ini di bagian paling bawah. Ini mengurus semua halaman
// seperti /login, /register, /logout, dll.
require __DIR__.'/auth.php';

// routes/web.php

// == ROUTE DARURAT UNTUK LOGOUT ==
Route::get('/keluar-paksa', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('message', 'Anda telah berhasil logout paksa.');
});