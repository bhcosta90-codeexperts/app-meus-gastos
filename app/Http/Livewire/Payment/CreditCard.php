<?php

namespace App\Http\Livewire\Payment;

use Livewire\Component;

class CreditCard extends Component
{
    public function render()
    {
        return view('livewire.payment.credit-card')->layout('layouts.front');
    }
}
