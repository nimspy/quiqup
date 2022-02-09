<?php

namespace nimspy\Quiqup;

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

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
            $this->token = $token_data['access_token'];
            //var_dump($token_data); exit;
        } else {
            $this->responseError('Token request error');
        }
    }

    /**
     * @param string $message
     */
    private function responseError(string $message)
    {
        $response = new JsonResponse(['error' => $message]);
        $response->send();
    }

    /**
     * @param $message
     * @return void
     */
    private function responseSuccess($message)
    {
        $response = new JsonResponse([
            'success' => true,
            'data' => $message,
        ]);
        $response->send();
    }

    /**
     * @return Job
     */
    public function makeJob(): Job
    {
        return new Job();
    }

    /**
     * @param Job $job
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createJob(Job $job)
    {
        try {
            $response = $this->client->request('POST', '/partner/jobs', [
                'body' => json_encode($job->getJob()),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                $createJob = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess([
                    'message' => 'Job created',
                    'id' => $createJob['id'],
                ]);
            } else {
                throw new \Exception('Create job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }

    /**
     * @param $page
     * @param $pageSize
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listJobs($page = 1, $pageSize = 10)
    {
        try {
            $response = $this->client->request('GET', '/partner/jobs', [
                'query' => [
                    'current' => true,
                    'timeframe' => 'present',
                    'current_page' => $page,
                    'per_page' => $pageSize,
                    'include' => 'waypoints', //waypoints, items, estimated_costs, orders
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $listJobs = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess($listJobs);
            } else {
                throw new \Exception('Get list job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submitJob($id)
    {
        try {
            $response = $this->client->request('POST', '/partner/jobs/' . $id . '/submissions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                $submitJob = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess($submitJob);
            } else {
                throw new \Exception('Submit job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelJob($id)
    {
        try {
            $response = $this->client->request('POST', '/partner/jobs/' . $id . '/cancellations', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                $cancelJob = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess($cancelJob);
            } else {
                throw new \Exception('Cancel job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param $scheduled_for
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateJob($id, $scheduled_for)
    {
        try {
            $response = $this->client->request('PUT', '/partner/jobs/' . $id, [
                'json' => ['scheduled_for' => date('c', strtotime($scheduled_for))],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $retrieveJob = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess($retrieveJob);
            } else {
                throw new \Exception('Retrieve job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveJob($id)
    {
        try {
            $response = $this->client->request('GET', '/partner/jobs/' . $id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $retrieveJob = json_decode($response->getBody()->getContents(), true);
                $this->responseSuccess($retrieveJob);
            } else {
                throw new \Exception('Retrieve job request error');
            }
        } catch (\Exception $e) {
            $this->responseError($e->getMessage());
        }
    }
}