<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $description;
    public $type;
    public $amount;
    public $photo;
    public $date;

    protected $rules = [
        'amount' => ['required', 'min:0.01', 'numeric'],
        'type' => ['required', 'in:1,2'],
        'description' => ['required', 'min:3', 'max:150'],
        'photo' => ['nullable', 'image']
    ];

    public function render()
    {
        return view('livewire.expense.create');
    }

    public function save()
    {

        try {
            $this->validate();

            if ($this->photo) {
                $photo = $this->photo->store('expenses-photos');
            }

            auth()->user()->expenses()->create([
                'type' => $this->type,
                'description' => $this->description,
                'amount' => $this->amount,
                'expense_at' => $this->date ?: now(),
                'photo' => $photo ?? null,
            ]);

            session()->flash('message', 'Registro criado com sucesso');

            $this->amount = $this->description = $this->type = $this->date = null;
        } catch (Exception $e) {
            if (isset($photo)) {
                $photo->delete();
            }

            throw $e;
        }
    }
}
