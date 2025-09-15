<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
class ProductPage extends Component
{
    use WithPagination;

    // Properti untuk form, di-bind dengan wire:model
    #[Rule('required|min:3')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required|numeric')]
    public $price;

    #[Rule('required|numeric')]
    public $stock;

    #[Rule('required')]
    public $type = 'dijual'; // default value

    public $slug;

    // Properti untuk mengontrol modal/dialog
    public bool $isModalOpen = false;

    // Method untuk membuka modal
    public function openModal()
    {
        $this->reset(); // Reset form fields
        $this->isModalOpen = true;
    }

    // Method untuk menutup modal
    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    // Method untuk menyimpan produk baru
    public function save()
    {
        $this->validate(); // Lakukan validasi

        // Buat slug dari nama produk
        $this->slug = Str::slug($this->name);

        Product::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'type' => $this->type,
        ]);

        session()->flash('message', 'Produk berhasil ditambahkan.');

        $this->closeModal();
    }


    public function render()
    {
        $products = Product::latest()->paginate(10);
        return view('livewire.admin.products.product-page', [
            'products' => $products
        ]);
    }
}