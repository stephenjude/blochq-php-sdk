<?php

namespace Stephenjude\BlocPhpSdk;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Stephenjude\BlocPhpSdk\Actions\ManagesAccounts;
use Stephenjude\BlocPhpSdk\Actions\ManagesBanks;
use Stephenjude\BlocPhpSdk\Actions\ManagesTransactions;
use Stephenjude\BlocPhpSdk\Actions\ManagesTransfers;

class BlocHQ
{
    use MakesHttpRequests;
    use ManagesBanks;
    use ManagesAccounts;
    use ManagesTransfers;
    use ManagesTransactions;

    /** @var string */
    public string $apiToken;

    public Client $client;

    public function __construct(string $apiToken, string $baseUri = 'https://api.blochq.io/v1/')
    {
        $this->apiToken = $apiToken;

        $this->client = new Client([
            'base_uri' => $baseUri,
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer {$this->apiToken}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    protected function transformCollection(array $collection, string $class): array
    {
        return array_map(function ($attributes) use ($class) {
            return new $class($attributes, $this);
        }, $collection);
    }
}