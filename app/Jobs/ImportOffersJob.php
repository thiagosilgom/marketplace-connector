<?php

namespace App\Jobs;

use App\Jobs\ImportOfferJob;
use App\Models\Offer;
use App\Services\Contracts\MarketplaceServiceInterface;
use App\States\FetchDetailsState;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Class ImportOffersJob
 *
 * Job responsible for fetching paginated offer references
 * and dispatching individual import jobs.
 */
class ImportOffersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param int $page
     */
    public function __construct(protected int $page = 1) {}

    /**
     * Execute the job.
     */
    public function handle(MarketplaceServiceInterface $marketplaceService): void
    {
        Log::info("Fetching offers on page {$this->page}");

        $response = $marketplaceService->getOffers($this->page);
        $references = $response['data']['offers'] ?? [];

        foreach ($references as $reference) {
            $offer = Offer::firstOrCreate(['reference' => $reference]);
            ImportOfferJob::dispatch($offer, app(FetchDetailsState::class));
        }

        if (isset($response['pagination']['next_page']) && $response['pagination']['next_page']) {
            ImportOffersJob::dispatch($response['pagination']['next_page']);
        }
    }
}
