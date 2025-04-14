<?php

namespace App\States;

use App\Models\Offer;

/**
 * Interface OfferImportStateInterface
 *
 * Represents a state in the offer import process.
 */
interface OfferImportStateInterface
{
    /**
     * Processes the current import state.
     */
    public function handle(Offer $offer): void;

    /**
     * Returns the next state if available.
     */
    public function next(): ?OfferImportStateInterface;
}
