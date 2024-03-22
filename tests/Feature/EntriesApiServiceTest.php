<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repository\Entity\IEntityRepository;
use App\Repository\Category\ICategoryRepository;
use App\Services\EntriesApiService;
use Database\Seeders\CategorySeeder;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use Mockery;
use GuzzleHttp\Psr7\Stream;


class EntriesApiServiceTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
    }

    public function test_can_process_response_api()
    {
        $bodyMock = json_encode([
            'entries' => [
                [
                    'Category' => 'Tecnología',
                    'API' => 'Google Maps Platform',
                    'Description' => 'API de Google Maps Platform',
                    'Auth' => 'apiKey',
                    'HTTPS' => true,
                    'Cors' => 'yes',
                    'Link' => 'https://developers.google.com/maps-platform/',
                    'Category' => 'Tecnología',
                ],
                [
                    'Category' => 'Finanzas',
                    'API' => 'Yahoo Finance API',
                    'Description' => 'API de Yahoo Finance',
                    'Auth' => 'apiKey',
                    'HTTPS' => true,
                    'Cors' => 'yes',
                    'Link' => 'https://finance.yahoo.com/developers/',
                    'Category' => 'Finanzas',
                ],
            ]
        ]);

        // Se crea un mock de la respuesta de la API
        $mockHandler = new MockHandler([
            new Response(200, [], $bodyMock),
        ]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);
        $mockHandler->append(new Response(200, [], $bodyMock));

        // Mock del repositorio de entidades
        $entityRepository = Mockery::mock(IEntityRepository::class);
        $entityRepository->shouldReceive('create')->twice();

        // Mock del repositorio de categorías
        $categoryRepository = Mockery::mock(ICategoryRepository::class);
        $categoryRepository->shouldReceive('getByName')->twice()->andReturn(new Category());

        // Se crea el servicio con los mocks
        $service = new EntriesApiService($entityRepository, $categoryRepository, $client);

        // Se ejecuta el método `getEntries`
        $service->getEntries();
    }
}
