<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin')]
class OrderPage extends Component
{
    use WithPagination;

    // Properti untuk form utama
    #[Rule('required')]
    public $customer_name;
    #[Rule('required')]
    public $customer_contact;
    #[Rule('required|date')]
    public $order_date;
    public $notes;
    #[Rule('required')]
    public $status = 'Baru';

    // Properti untuk item pesanan
    public $orderItems = [];
    public $total_amount = 0;

    // Properti untuk pencarian produk
    public $searchQuery = '';
    public $searchResults = [];

    // Properti untuk mode Edit & Modal
    public $orderId;
    public bool $isModalOpen = false;

    // --- FUNGSI MODAL & FORM ---
    public function create()
    {
        $this->reset();
        $this->order_date = now()->format('Y-m-d'); // Set tanggal hari ini
        $this->openModal();
    }

    public function edit($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        $this->orderId = $id;
        $this->customer_name = $order->customer_name;
        $this->customer_contact = $order->customer_contact;
        $this->order_date = $order->order_date;
        $this->status = $order->status;
        $this->notes = $order->notes;
        
        $this->orderItems = [];
        foreach ($order->items as $item) {
            $this->orderItems[] = [
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->price
            ];
        }
        $this->calculateTotal();
        $this->openModal();
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->reset(); }

    // --- FUNGSI PENCARIAN & ITEM PRODUK ---
    public function updatedSearchQuery()
    {
        if (strlen($this->searchQuery) >= 2) {
            $this->searchResults = Product::where('name', 'like', '%' . $this->searchQuery . '%')
                ->limit(5)
                ->get();
        } else {
            $this->searchResults = [];
        }
    }

    public function addProduct(Product $product)
    {
        // Cek jika produk sudah ada di keranjang
        foreach ($this->orderItems as $key => $item) {
            if ($item['product_id'] === $product->id) {
                $this->orderItems[$key]['quantity']++;
                $this->calculateTotal();
                $this->resetSearch();
                return;
            }
        }

        // Jika belum ada, tambahkan baru
        $this->orderItems[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price
        ];
        $this->calculateTotal();
        $this->resetSearch();
    }
    
    public function removeProduct($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
        $this->calculateTotal();
    }
    
    public function calculateTotal()
    {
        $this->total_amount = collect($this->orderItems)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
    }

    private function resetSearch()
    {
        $this->searchQuery = '';
        $this->searchResults = [];
    }

    // --- FUNGSI UTAMA (SAVE, DELETE, RENDER) ---
    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $orderData = [
                'customer_name' => $this->customer_name,
                'customer_contact' => $this->customer_contact,
                'order_date' => $this->order_date,
                'status' => $this->status,
                'notes' => $this->notes,
                'total_amount' => $this->total_amount,
            ];

            if ($this->orderId) {
                // Mode Update
                $order = Order::find($this->orderId);
                $order->update($orderData);
                $order->items()->delete(); // Hapus item lama
                
                foreach ($this->orderItems as $item) {
                    $order->items()->create($item);
                }
                session()->flash('message', 'Pesanan berhasil diperbarui.');

            } else {
                // Mode Create
                $order = Order::create($orderData);
                foreach ($this->orderItems as $item) {
                    $order->items()->create($item);
                }
                session()->flash('message', 'Pesanan berhasil ditambahkan.');
            }
        });

        $this->closeModal();
    }

    public function delete($id)
    {
        Order::find($id)->delete();
        session()->flash('message', 'Pesanan berhasil dihapus.');
    }

    public function render()
    {
        $orders = Order::latest()->paginate(10);
        return view('livewire.admin.orders.order-page', [
            'orders' => $orders,
        ]);
    }
}