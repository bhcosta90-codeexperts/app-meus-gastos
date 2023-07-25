<?php


namespace App\Services\PagSeguro\Subscription;

use App\Services\PagSeguro\Credentials;
use Illuminate\Support\Facades\Http;

class SubscriptionService
{
    public static function makeSubscription($data)
    {
        $url = Credentials::getCredentials('/pre-approvals');

        $response = Http::timeout(10)->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
        ])
            ->post($url, [
                'plan' => $data['plan_reference'],
                'sender' => [
                    'name' => 'Teste Usuário Sender',
                    'email' => 'teste@sandbox.pagseguro.com.br',
                    'hash' => $data['senderHash'],
                    'phone' => [
                        'areaCode' => '98',
                        'number'   => '984283432'
                    ],
                    'address' => [
                        'street' => 'Rua Teste',
                        'number' => '29',
                        'complement' => '',
                        'district' => 'São Bernado',
                        'city' => 'São Luis',
                        'state' => 'MA',
                        'country' => 'BRA',
                        'postalCode' => '65056000'
                    ],
                    'documents' => [
                        [
                            'type' => 'CPF',
                            'value' => '31194789030'
                        ]
                    ]
                ],
                'paymentMethod' => [
                    'type' => 'CREDITCARD',
                    'creditCard' => [
                        'token' => $data['token'],
                        'holder' => [
                            'name' => 'Customer Credit Name',
                            'birthDate' => '30/10/1990',
                            'documents' => [
                                [
                                    'type' => 'CPF',
                                    'value' => '31194789030'
                                ]
                            ],
                            'billingAddress' => [
                                'street' => 'Rua Teste',
                                'number' => '29',
                                'complement' => '',
                                'district' => 'São Bernado',
                                'city' => 'São Luis',
                                'state' => 'MA',
                                'country' => 'BRA',
                                'postalCode' => '65056000'
                            ],
                            'phone' => [
                                'areaCode' => '98',
                                'number'   => '984283432'
                            ]
                        ]

                    ]
                ]
            ]);

        return SubscriptionReaderService::getSubscriptionByCode($response->json()['code']);
    }
}
