<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class Create extends Component
{
    public $description;
    public $type;
    public $amount;

    public function render()
    {
        return view('livewire.expense.create');
    }

    public function save(){
        Expense::create([
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
            'user_id' => 1,
        ]);
    }
}
