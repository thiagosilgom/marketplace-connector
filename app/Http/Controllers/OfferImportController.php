<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Jobs\ImportOffersJob;

/**
 * Class OfferImportController
 *
 * Handles the import request for offers.
 * Dispatches a background job to process the import asynchronously.
 *
 * @package App\Http\Controllers
 */
class OfferImportController extends Controller
{
    /**
     * Handle the incoming import request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        ImportOffersJob::dispatch();

        return response()->json([
            'message' => 'Import request received successfully. The process will run in the background.'
        ], 202);
    }
}
