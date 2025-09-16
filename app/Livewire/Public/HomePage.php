<?php
namespace App\Livewire\Public;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\HeroSlider; 

#[Layout('components.layout.app')] // <-- Menggunakan layout 'app.blade.php'
class HomePage extends Component
{
    public function render()
    {
        $featuredProducts = Product::latest()->take(6)->get();
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get(); // Tambahkan ini

        return view('livewire.public.home-page', [
            'featuredProducts' => $featuredProducts,
            'sliders' => $sliders, // Kirim data sliders ke view
        ]);
    }
}