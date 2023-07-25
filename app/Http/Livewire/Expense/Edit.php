<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class Edit extends Component
{
    public Expense $expense;
    public $description;
    public $type;
    public $amount;

    protected $rules = [
        'amount' => ['required', 'min:0.01', 'numeric'],
        'type' => ['required', 'in:1,2'],
        'description' => ['required', 'min:3', 'max:150'],
    ];

    public function mount()
    {
        $this->description = $this->expense->description;
        $this->type = $this->expense->type;
        $this->amount = $this->expense->amount;
    }

    public function render()
    {
        return view('livewire.expense.edit');
    }

    public function save()
    {

        $this->validate();

        $this->expense->update([
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
            'user_id' => 1,
        ]);

        session()->flash('message', 'Registro alterado com sucesso');
    }
}
