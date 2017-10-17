<?php

namespace MfCloud;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client as Guzzle;

class Client
{
    const BASE_URL = 'https://invoice.moneyforward.com/api';

    protected $accessToken, $apiVersion;

    /**
     * Create a new MfCloud client.
     */
    public function __construct(
        string $accessToken,
        Guzzle $guzzle = null,
        string $apiVersion = 'v1'
    ) {
        $this->accessToken = $accessToken;

        if (is_null($guzzle)) {
            $this->guzzle = new Guzzle([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->accessToken,
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                ]
            ]);
        }

        $this->apiVersion = $apiVersion;
    }

    public function get(string $path, array $params = [])
    {
        return (string)$this->guzzle->request(
            'GET',
            $this->buildUrl($path),
            $params
        )->getBody();
    }

    protected function buildUrl($path) : string
    {
        return implode('/', [static::BASE_URL, $this->apiVersion, $path]);
    }

}
