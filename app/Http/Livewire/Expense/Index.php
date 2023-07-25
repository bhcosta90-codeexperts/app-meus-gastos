<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $expenses = auth()->user()->expenses()
            ->orderBy('expense_at', 'desc')
            ->paginate(columns: ['id', 'description', 'amount', 'type', 'expense_at', 'created_at']);
        return view('livewire.expense.index', compact('expenses'));
    }

    public function remove($expense){
        $expense = auth()->user()->expenses()->findOrFail($expense);
        $expense->delete();

        session()->flash('message', 'Registro removido com sucesso');
    }
}
