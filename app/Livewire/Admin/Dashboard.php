<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')] // <-- Pastikan menggunakan layout admin kita
class Dashboard extends Component
{
    public function render()
    {
        // Menghitung data statistik dari model Product
        $totalProducts = Product::count();
        $productsForSale = Product::where('type', 'dijual')->count();
        $productsForRent = Product::where('type', 'disewakan')->count();

        // Mengirim data ke view
        return view('livewire.admin.dashboard', [
            'totalProducts' => $totalProducts,
            'productsForSale' => $productsForSale,
            'productsForRent' => $productsForRent,
        ]);
    }
}