<?php

namespace Tests\Feature\Entities;

use App\Http\Controllers\EntriesController;
use App\Models\Category;
use App\Models\Entity;
use App\Services\EntriesApiService;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListEntitiesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
    }

    public function test_can_fetch_all_entities(): void
    {
        $entities = Entity::factory()->count(2)->create();

        $category_name = Category::find(1)->category;

        $response = $this->getJson(route('api.entities.get', $category_name));

        $response->assertStatus(200);

        $response->assertExactJson([
            'success' => true,
            'data' => [
                [
                    'api' => $entities[0]->api,
                    'description' => $entities[0]->description,
                    'link' => $entities[0]->link,
                    "category" => [
                        "id" => 1,
                        "category" => $category_name
                    ]
                ],
                [
                    'api' => $entities[1]->api,
                    'description' => $entities[1]->description,
                    'link' => $entities[1]->link,
                    "category" => [
                        "id" => 1,
                        "category" => $category_name
                    ]
                ],
            ],
        ]);
    }

}
