<?php

namespace App\Events;

use App\Models\Offer;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OfferImported
 *
 * Event dispatched when an offer has been completely imported.
 */
class OfferImported
{
    use Dispatchable, SerializesModels;

    /**
     * @param Offer $offer
     */
    public function __construct(public Offer $offer) {}
}
