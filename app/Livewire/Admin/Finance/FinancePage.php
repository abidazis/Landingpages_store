<?php

namespace App\Livewire\Admin\Finance;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin')]
class FinancePage extends Component
{
    use WithPagination;

    // Properti untuk form
    #[Rule('required|date')]
    public $date;
    #[Rule('required')]
    public $type = 'pengeluaran'; // Default ke pengeluaran
    #[Rule('required|min:3')]
    public $description;
    #[Rule('required|numeric|min:1')]
    public $amount;

    public bool $isModalOpen = false;

    public function create()
    {
        $this->reset();
        $this->date = now()->format('Y-m-d');
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        Transaction::create($this->all());

        session()->flash('message', 'Transaksi berhasil ditambahkan.');
        $this->closeModal();
    }

    public function render()
    {
        $transactions = Transaction::latest()->paginate(15);

        $totalIncome = Transaction::where('type', 'pemasukan')->sum('amount');
        $totalExpense = Transaction::where('type', 'pengeluaran')->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        return view('livewire.admin.finance.finance-page', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netProfit' => $netProfit,
        ]);
    }
}