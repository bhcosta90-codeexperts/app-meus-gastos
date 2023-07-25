<?php

namespace App\Http\Livewire\Payment;

use App\Models\Plan;
use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Subscription\SubscriptionService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Throwable;

class CreditCard extends Component
{
    public $sessionId;
    public Plan $plan;

    protected $listeners = [
        'paymentData' => 'processSubscription'
    ];

    public function mount()
    {
        $url = Credentials::getCredentials('/sessions/');
        $response = Http::timeout(10)->post($url, []);
        $responseXml = simplexml_load_string($response->body());
        $this->sessionId = (string) $responseXml->id;
        $this->plan = Plan::first();
    }

    public function processSubscription($payload) {
        $data['plan_reference'] = $this->plan->reference;
        $makeSubscription = SubscriptionService::makeSubscription($data + $payload);

        $user = auth()->user();

        $user->plan()->create([
            'plan_id' => $this->plan->id,
            'status'  => $makeSubscription['status'],
            'date_subscription' => (\DateTime::createFromFormat(DATE_ATOM, $makeSubscription['date']))->format('Y-m-d H:i:s'),
            'reference_transaction' => $makeSubscription['code'],
        ]);

        session()->flash('message', 'Plano Aderido com Sucesso');

        $this->emit('subscriptionFinished');
    }

    public function render()
    {
        return view('livewire.payment.credit-card')->layout('layouts.front');
    }
}
