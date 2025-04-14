<?php

namespace App\Services\Marketplace;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\MarketplaceServiceInterface;

/**
 * Class MarketplaceMockService
 *
 * Mock implementation of the MarketplaceServiceInterface.
 * Interacts with a mock marketplace API to retrieve offer data.
 *
 * @package App\Services\Marketplace
 */
class MarketplaceMockService implements MarketplaceServiceInterface
{
    /**
     * The base URL of the mock marketplace service.
     *
     * @var string
     */
    protected string $baseUrl;

    /**
     * MarketplaceMockService constructor.
     *
     * Initializes the base URL from the configuration.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.marketplace.base_url', 'http://localhost:3000');
    }

    /**
     * Get a paginated list of offers from the marketplace.
     *
     * @param int $page The page number to retrieve.
     * @return array Returns an array of offers.
     */
    public function getOffers(int $page): array
    {
        return Http::get("{$this->baseUrl}/offers", ['page' => $page])->json();
    }

    /**
     * Get the details of a specific offer.
     *
     * @param string $id The ID of the offer.
     * @return array Returns an array with the offer details.
     */
    public function getOfferDetails(string $id): array
    {
        return Http::get("{$this->baseUrl}/offers/{$id}")->json('data');
    }

    /**
     * Get the images of a specific offer.
     *
     * @param string $id The ID of the offer.
     * @return array Returns an array of image URLs.
     */
    public function getOfferImages(string $id): array
    {
        return Http::get("{$this->baseUrl}/offers/{$id}/images")->json('data.images');
    }

    /**
     * Get the price of a specific offer.
     *
     * @param string $id The ID of the offer.
     * @return float Returns the price of the offer.
     */
    public function getOfferPrice(string $id): float
    {
        return Http::get("{$this->baseUrl}/offers/{$id}/prices")->json('data.price');
    }
}
