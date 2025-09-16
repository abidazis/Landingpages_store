<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage; 
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
class ProductPage extends Component
{
    use WithPagination;
    use WithFileUploads;

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
    public $image_url;
    
    public $slug;
    public $productId;
    public $existing_image_url;

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
        $this->existing_image_url = $product->image_url;
        
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
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'type' => 'required',
        ];

        if ($this->productId) {
            $rules['image_url'] = 'nullable|image|max:2048'; // Tidak wajib saat edit
        } else {
            $rules['image_url'] = 'required|image|max:2048'; // Wajib saat create
        }
        $this->validate($rules);

        $data = $this->only(['name', 'description', 'price', 'stock', 'type']);
        $data['slug'] = Str::slug($this->name);

        if ($this->image_url) {
            if ($this->productId && $this->existing_image_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $this->existing_image_url));
            }
            $path = $this->image_url->store('products', 'public');
            $data['image_url'] = Storage::url($path);
        }

        Product::updateOrCreate(['id' => $this->productId], $data);
        session()->flash('message', $this->productId ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');
        $this->closeModal();
    }

    public function render()
    {
        $products = Product::latest()->paginate(10);
        return view('livewire.admin.products.product-page', [
            'products' => $products
        ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image_url));
        }
        $product->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }
}