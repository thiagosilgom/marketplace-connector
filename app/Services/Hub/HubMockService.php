<?php

namespace App\Services\Hub;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\HubServiceInterface;

/**
 * Class HubMockService
 *
 * Mock implementation of the HubServiceInterface.
 * Sends offer creation requests to a mock hub endpoint.
 *
 * @package App\Services\Hub
 */
class HubMockService implements HubServiceInterface
{
    /**
     * The base URL of the mock hub service.
     *
     * @var string
     */
    protected string $baseUrl;

    /**
     * HubMockService constructor.
     *
     * Initializes the base URL from the configuration.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.hub.base_url', 'http://localhost:3000');
    }

    /**
     * Send a request to create a new offer on the mock hub.
     *
     * @param array $payload The data to be sent in the offer creation request.
     * @return bool Returns true if the request was successful, false otherwise.
     */
    public function createOffer(array $payload): bool
    {
        $response = Http::post("{$this->baseUrl}/hub/create-offer", $payload);
        return $response->successful();
    }
}
