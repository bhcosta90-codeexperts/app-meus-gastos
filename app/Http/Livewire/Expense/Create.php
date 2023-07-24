<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class Create extends Component
{
    public $description;
    public $type;
    public $amount;

    protected $rules = [
        'amount' => ['required', 'min:0.01', 'numeric'],
        'type' => ['required', 'in:1,2'],
        'description' => ['required', 'min:3', 'max:150'],
    ];

    public function render()
    {
        return view('livewire.expense.create');
    }

    public function save()
    {

        $this->validate();

        Expense::create([
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
            'user_id' => 1,
        ]);

        session()->flash('message', 'Registro criado com sucesso');

        $this->amount = $this->description = $this->type = null;
    }
}
