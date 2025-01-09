<?php

namespace tests\Feature;

use Illuminate\Support\Facades\Http;
use App\Services\NytApiService;
use Tests\TestCase;
use Exception;

/**
 *
 */
class NytBestSellersTest extends TestCase
{

    /** @test
     * @throws Exception
     */
    public function test_valid_best_sellers_response()
    {
        // Mock a valid API response
        Http::fake([
            'api.nytimes.com/*' => Http::response([
                'results' => [
                    [
                        'list_name' => 'Hardcover Fiction',
                        'results' => [
                            [
                                'title' => 'Test Book',
                                'author' => 'Test Author',
                                'publisher' => 'Test Publisher',
                            ],
                        ],
                    ],
                ],
            ])
        ]);

        // Create an instance of the service or request
        $service = app(NytApiService::class);

        // Make the call to the API
        $response = $service->getBestSellers();

        // Assert the response data
        $this->assertIsArray($response);
        $this->assertArrayHasKey('results', $response);
        $this->assertEquals('Hardcover Fiction', $response['results'][0]['list_name']);
        $this->assertEquals('Test Book', $response['results'][0]['results'][0]['title']);
        $this->assertEquals('Test Author', $response['results'][0]['results'][0]['author']);
    }


    /** @test
     * @throws Exception
     */
    public function test_nyt_api_service_not_available()
    {
        // Simulate an unavailable API
        Http::fake([
            'api.nytimes.com/*' => Http::response(null, 503)
        ]);

        // Create an instance of the service
        $service = app(NytApiService::class);

        // Expect an exception to be thrown
        $this->expectException(Exception::class);

        // Attempt to call the API
        $service->getBestSellers();
    }
}
