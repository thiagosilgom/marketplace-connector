<?php

namespace App\Services\Contracts;

/**
 * Interface HubServiceInterface
 *
 * Defines the contract for services that handle offer creation on external hubs.
 *
 * @package App\Services\Contracts
 */
interface HubServiceInterface
{
    /**
     * Create a new offer on the hub with the given payload.
     *
     * @param array $payload The data required to create the offer.
     * @return bool Returns true on success, false on failure.
     */
    public function createOffer(array $payload): bool;
}
