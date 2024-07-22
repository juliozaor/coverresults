<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseService
{
    /* protected $client;
    protected $serverKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->serverKey = config('firebase.server_key');
    }

    public function sendNotification($token, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $data = [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
        ];

        $headers = [
            'Authorization' => 'key=' . $this->serverKey,
            'Content-Type' => 'application/json',
        ];

        $response = $this->client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);

        return $response->getStatusCode() === 200;
    } */

    protected $client;
    protected $serverKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->serverKey = config('services.firebase.server_key');
    }

    public function sendNotification($token, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $data = [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
        ];

        $headers = [
            'Authorization' => 'key=' . $this->serverKey,
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $data,
            ]);

            return $response->getStatusCode() === 200;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error('Error sending notification: ' . $e->getMessage());
            return false;
        }
    }

}
