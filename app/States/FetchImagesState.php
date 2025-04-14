<?php

namespace App\States;

use App\Models\Offer;
use App\Services\Contracts\MarketplaceServiceInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class FetchImagesState
 *
 * Handles fetching offer images from the Marketplace.
 */
class FetchImagesState implements OfferImportStateInterface
{
    public function __construct(protected MarketplaceServiceInterface $marketplaceService) {}

    public function handle(Offer $offer): void
    {
        try {
            Log::info("Fetching images for offer {$offer->reference}");
            $images = $this->marketplaceService->getOfferImages($offer->reference);
            $offer->images = $images;
            $offer->save();
        } catch (Throwable $e) {
            Log::error("Error fetching images for offer {$offer->reference}: {$e->getMessage()}", [
                'exception' => $e,
            ]);
        }
    }

    public function next(): ?OfferImportStateInterface
    {
        return app(FetchPriceState::class);
    }
}
