<?php
namespace App\Livewire\Public;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class CatalogPage extends Component
{
    use WithPagination;

    public $filterType = 'semua';

    public function setFilter($type)
    {
        $this->filterType = $type;
        $this->resetPage(); // Reset paginasi saat filter berubah
    }

    public function render()
    {
        $products = Product::when($this->filterType != 'semua', function ($query) {
            $query->where('type', $this->filterType);
        })->latest()->paginate(9);

        return view('livewire.public.catalog-page', [
            'products' => $products
        ]);
    }
}