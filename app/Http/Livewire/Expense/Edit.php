<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Expense $expense;
    public $description;
    public $type;
    public $amount;
    public $photo;

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

        try {

            $photoOld = $this->expense->photo;
            
            if ($this->photo) {
                $photo = $this->photo->store('expenses-photos');
            }

            $this->expense->update([
                'type' => $this->type,
                'description' => $this->description,
                'amount' => $this->amount,
                'photo' => $photo ?? $photoOld,
            ]);

            if (!empty($photo) && $photoOld &&  Storage::exists($photoOld)) {
                Storage::delete($photoOld);
            }

            session()->flash('message', 'Registro alterado com sucesso');
        } catch (Exception $e) {
            if (isset($photo)) {
                $photo->delete();
            }

            throw $e;
        }
    }
}
