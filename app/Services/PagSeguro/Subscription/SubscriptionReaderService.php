<?php

namespace App\Services\PagSeguro\Subscription;

use App\Services\PagSeguro\Credentials;
use Illuminate\Support\Facades\Http;

class SubscriptionReaderService
{
    public static function getSubscriptionByCode($subscriptionCode)
    {
        $url = Credentials::getCredentials('/pre-approvals/' . $subscriptionCode);
        return self::subscriptionReader($url);
    }

    public static function getSubscriptionByNotificationCode($notificationCode)
    {
        $url = Credentials::getCredentials('/pre-approvals/notifications/' . $notificationCode);
        return self::subscriptionReader($url);
    }

    private static function subscriptionReader($urlCode)
    {
        $response = Http::timeout(config('pagseguro.timeout'))->withHeaders(
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
            ]
        )
            ->get($urlCode);

        return $response->json();
    }
}
