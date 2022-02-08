<?php

namespace nimspy\quiqup;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Quiqup
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $client_secret;
    /**
     * @var string
     */
    private $client_id;

    private $token;

    public function __construct(array $options)
    {
        if (!isset($options['client_secret']) || !isset($options['client_id'])) {
            $this->responseError('"client_secret" or "client_id" not be set!');
        }

        $this->client_secret = $options['client_secret'];
        $this->client_id = $options['client_id'];

        if (isset($options['api_url'])) {
            $this->client = new Client(['base_uri' => $options['api_url']]);
        } else {
            $this->responseError('API url not be set');
        }
        $this->createToken();
    }

    private function createToken()
    {
        $params = [
            'grant_type' => 'client_credentials',
            'client_secret' => $this->client_secret,
            'client_id' => $this->client_id,
        ];

        $response = $this->client->request('POST', '/oauth/token', [
            'json' => $params,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $token_data = json_decode($response->getBody()->getContents(), true);
            var_dump($token_data);
        } else {
            $this->responseError('Token request error');
        }
    }

    private function responseError(string $message)
    {
        $response = new JsonResponse(['error' => $message]);
        $response->send();
    }
}