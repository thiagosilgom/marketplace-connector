<?php

namespace App\Jobs;

use App\Events\OfferImported;
use App\Models\Offer;
use App\States\OfferImportStateInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Class ImportOfferJob
 *
 * Job for processing each state of the offer import.
 */
class ImportOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param Offer $offer
     * @param OfferImportStateInterface $state
     */
    public function __construct(
        public Offer $offer,
        public OfferImportStateInterface $state
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Importing offer {$this->offer->reference} at state " . get_class($this->state));
        $this->state->handle($this->offer);

        if ($next = $this->state->next()) {
            ImportOfferJob::dispatch($this->offer, $next);
        } else {
            event(new OfferImported($this->offer));
        }
    }
}
