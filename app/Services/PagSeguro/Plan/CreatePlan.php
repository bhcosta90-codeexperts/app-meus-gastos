<?php

namespace App\Services\PagSeguro\Plan;

use Illuminate\Support\Facades\Http;

class CreatePlan
{
    public static function makeRequest(array $data)
    {
        $response = Http::timeout(5)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => config('pagseguro.token')
        ])->post(
            'https://sandbox.api.assinaturas.pagseguro.com/plans',
            [
                "amount" => [
                    "value" => (float) $data['price'],
                    "currency" => "BRL"
                ],
                "interval" => [
                    "unit" => "MONTH"
                ],
                "name" => $data['slug']
            ]
        );

        return $response->json()['id'];
    }
}
