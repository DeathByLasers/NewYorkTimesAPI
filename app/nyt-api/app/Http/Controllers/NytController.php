<?php

namespace App\Http\Controllers;

use App\Http\Requests\NytBestSellersRequest;
use App\Services\NytApiService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class NytController extends Controller
{
    /**
     * @var NytApiService
     */
    protected NytApiService $nytApiService;

    /**
     * @param NytApiService $nytApiService
     */
    public function __construct(NytApiService $nytApiService)
    {
        $this->nytApiService = $nytApiService;
    }

    /**
     * @param NytBestSellersRequest $request
     * @return JsonResponse
     */
    public function getBestSellers(NytBestSellersRequest $request): JsonResponse
    {
        try {
            $data = $this->nytApiService->getBestSellers($request->validated());
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
