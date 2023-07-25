<?php

namespace App\Services\PagSeguro\Plan;

use App\Services\PagSeguro\Credentials;
use Illuminate\Support\Facades\Http;

class CreatePlan
{
    public static function makeRequest(array $data)
    {
        $url = Credentials::getCredentials('/pre-approvals/request/');

        $response = Http::timeout(3)->withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Content-Type' => 'application/json'
        ])->post(
            $url,
            [
                'reference' => $data['slug'],
                'preApproval' => [
                    'name' => $data['name'],
                    'charge' => 'AUTO',
                    'period' => 'MONTHLY',
                    'amountPerPayment' => number_format($data['price'], 2),
                ]
            ]
        );

        return $response->json()['code'];
    }
}
