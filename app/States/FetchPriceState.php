<?php

namespace App\States;

use App\Models\Offer;
use App\Services\Contracts\MarketplaceServiceInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class FetchPriceState
 *
 * Handles fetching offer price from the Marketplace.
 */
class FetchPriceState implements OfferImportStateInterface
{
    public function __construct(protected MarketplaceServiceInterface $marketplaceService) {}

    public function handle(Offer $offer): void
    {
        try {
            Log::info("Fetching price for offer {$offer->reference}");
            $offer->price = $this->marketplaceService->getOfferPrice($offer->reference);
            $offer->save();
        } catch (Throwable $e) {
            Log::error("Error fetching price for offer {$offer->reference}: {$e->getMessage()}", [
                'exception' => $e,
            ]);
        }
    }

    public function next(): ?OfferImportStateInterface
    {
        return null;
    }
}
