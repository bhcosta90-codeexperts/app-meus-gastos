<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $plans = Plan::orderBy('created_at', 'desc')
            ->paginate(columns: [
                'id',
                'name',
                'description',
                'price',
                'reference',
                'slug',
                'created_at',
            ]);

        return view('livewire.plan.index', compact('plans'));
    }

    public function remove(Plan $plan)
    {
        $plan->delete();
        session()->flash('message', 'Registro removido com sucesso');
    }
}
