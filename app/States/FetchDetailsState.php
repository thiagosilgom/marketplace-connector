<?php

namespace App\States;

use App\Models\Offer;
use App\Services\Contracts\MarketplaceServiceInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class FetchDetailsState
 *
 * Handles fetching offer details from the Marketplace.
 */
class FetchDetailsState implements OfferImportStateInterface
{
    public function __construct(protected MarketplaceServiceInterface $marketplaceService) {}

    public function handle(Offer $offer): void
    {
        try {
            Log::info("Fetching details for offer {$offer->reference}");
            $details = $this->marketplaceService->getOfferDetails($offer->reference);
            $offer->fill($details)->save();
        } catch (Throwable $e) {
            Log::error("Error fetching details for offer {$offer->reference}: {$e->getMessage()}", [
                'exception' => $e,
            ]);
        }
    }

    public function next(): ?OfferImportStateInterface
    {
        return app(FetchImagesState::class);
    }
}
