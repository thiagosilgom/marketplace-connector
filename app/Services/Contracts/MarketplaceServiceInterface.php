<?php

namespace App\Services\Contracts;

/**
 * Interface MarketplaceServiceInterface
 *
 * Defines the contract for retrieving offers and their related data from a marketplace.
 *
 * @package App\Services\Contracts
 */
interface MarketplaceServiceInterface
{
    /**
     * Retrieve a paginated list of offers.
     *
     * @param int $page The page number to retrieve.
     * @return array Returns an array of offers for the specified page.
     */
    public function getOffers(int $page): array;

    /**
     * Retrieve the details of a specific offer by its ID.
     *
     * @param string $id The unique identifier of the offer.
     * @return array Returns an array containing the offer's details.
     */
    public function getOfferDetails(string $id): array;

    /**
     * Retrieve the images associated with a specific offer.
     *
     * @param string $id The unique identifier of the offer.
     * @return array Returns an array of image URLs or image metadata.
     */
    public function getOfferImages(string $id): array;

    /**
     * Retrieve the price of a specific offer.
     *
     * @param string $id The unique identifier of the offer.
     * @return float Returns the price of the offer.
     */
    public function getOfferPrice(string $id): float;
}
