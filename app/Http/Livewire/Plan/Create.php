<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public array $plan = [
        'name' => null,
        'description' => null,
        'price' => null,
        'slug' => null,
    ];

    protected $rules = [
        'plan.name' => 'required',
        'plan.description' => 'required',
        'plan.price' => 'required',
        'plan.slug' => 'required',
    ];

    public function render()
    {
        return view('livewire.plan.create');
    }

    public function save()
    {
        $plan = $this->validate()['plan'];

        Plan::create($plan + [
            'reference' => 'PAGSEGURO-REFERENCE',
        ]);

        session()->flash('message', 'Registro criado com sucesso');

        $this->plan = [];
    }
}
