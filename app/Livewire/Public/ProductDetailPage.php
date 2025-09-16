<?php

namespace App\Livewire\Public;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
class ProductDetailPage extends Component
{
    public Product $product;

    // Livewire & Laravel akan otomatis mengisi properti $product
    // dengan data dari URL. Kita hanya perlu menerimanya di method mount.
    public function mount(Product $product)
    {
        $this->product = $product;
    }

    // [Opsional] Membuat judul halaman browser menjadi dinamis
    #[Title('')]
    public function getTitle()
    {
        return $this->product->name . ' - Atribut Paskibra Cikarang';
    }

    public function render()
    {
        return view('livewire.public.product-detail-page');
    }
}