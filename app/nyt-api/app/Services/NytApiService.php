<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class NytApiService
{
    /**
     * @var mixed
     */
    protected mixed $apiUrl;
    /**
     * @var mixed
     */
    protected mixed $apiKey;

    /**
     * Set the url and key
     */
    public function __construct()
    {
        $this->apiUrl = env('API_URL');
        $this->apiKey = env('API_KEY');
    }

    /**
     * @param array $filters
     * @return array|mixed
     * @throws Exception
     */
    public function getBestSellers(array $filters = []): mixed
    {
        $queryParams = array_merge(
            ['api-key' => $this->apiKey],
            $this->transformFilters($filters)
        );

        $response = Http::get("$this->apiUrl/lists/best-sellers/history.json", $queryParams);

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception('Failed to fetch data from NYT API: ' . $response->body(), $response->status());
    }

    /**
     * @param array $filters
     * @return array
     */
    private function transformFilters(array $filters): array
    {
        if (isset($filters['isbn'])) {
            $filters['isbn'] = implode(';', $filters['isbn']);
        }

        return $filters;
    }
}
