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

    // Properti untuk form
    #[Rule('required|min:3')]
    public $name;
    #[Rule('required')]
    public $description;
    #[Rule('required|numeric')]
    public $price;
    #[Rule('required|numeric')]
    public $stock;
    #[Rule('required')]
    public $type = 'dijual';
    public $slug;

    // Properti untuk mode Edit
    public $productId;

    public bool $isModalOpen = false;

    // Method untuk membuka modal dalam mode 'Tambah Baru'
    public function create()
    {
        $this->reset(); // Reset semua properti
        $this->openModal();
    }
    
    // Method untuk membuka modal dalam mode 'Edit'
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->type = $product->type;
        
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset();
    }
    
    // Method save yang sekarang bisa menangani 'create' dan 'update'
    public function save()
    {
        $this->validate();

        // Buat slug baru jika nama berubah
        $this->slug = Str::slug($this->name);

        // Jika ada productId, berarti mode update. Jika tidak, mode create.
        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update($this->all());
            session()->flash('message', 'Produk berhasil diperbarui.');
        } else {
            Product::create($this->all());
            session()->flash('message', 'Produk berhasil ditambahkan.');
        }

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