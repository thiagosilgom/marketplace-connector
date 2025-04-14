<?php

namespace App\Listeners;

use App\Events\OfferImported;
use App\Services\Contracts\HubServiceInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class SendOfferToHub
 *
 * Listener responsible for sending the offer to the HUB after import.
 */
class SendOfferToHub
{
    public function __construct(protected HubServiceInterface $hubService) {}

    /**
     * Handle the event.
     *
     * @param OfferImported $event
     * @return void
     */
    public function handle(OfferImported $event): void
    {
        try {
            Log::info("Sending offer {$event->offer->reference} to HUB");
            $success = $this->hubService->createOffer($event->offer->toArray());

            if (!$success) {
                Log::warning("HUB did not accept offer {$event->offer->reference}");
            }
        } catch (Throwable $e) {
            Log::error("Error sending offer {$event->offer->reference} to HUB: {$e->getMessage()}", [
                'exception' => $e,
            ]);
        }
    }
}
