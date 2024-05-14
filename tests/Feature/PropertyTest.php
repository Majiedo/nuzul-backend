<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Property;

class PropertyTest extends TestCase
{

    use RefreshDatabase;


    public function test_the_api_returns_a_properties_list(): void
    {
        Property::factory()->create(
            [
                "title"=> "The Victoria",
                "price"=> 374662,
                "address"=> "81 Freshwater St, Torquay VIC 3228",
                "bedrooms"=> 4,
                "bathrooms"=> 2,
            ]
        );

        $response = $this->getJson('/api/properties');

        $response->assertStatus(200)->assertJsonStructure([
            "data" => [0 => ['id', 'title', 'price', 'bedrooms', 'bathrooms', 'address']]
        ]);
    }

    public function test_the_api_returns_a_property():void
    {
        Property::factory()->create(
            [
                "title"=> "The Victoria",
                "price"=> 374662,
                "address"=> "81 Freshwater St, Torquay VIC 3228",
                "bedrooms"=> 4,
                "bathrooms"=> 2,
            ]
        );
        $response = $this->getJson('/api/properties/1');

        $response->assertStatus(200)->assertJsonStructure([
            "data" => ['id', 'title', 'price', 'bedrooms', 'bathrooms', 'address']
        ]);
    }

    public function test_the_api_returns_404_with_a_non_existent_id():void
    {
        $response = $this->getJson('/api/properties/999999');

        $response->assertStatus(404);
    }

    public function test_the_api_returns_201_create_property():void
    {
        $response = $this->postJson('/api/properties', [
            "title"=> "The Victoria",
            "price"=> 374662,
            "address"=> "81 Freshwater St, Torquay VIC 3228",
            "bedrooms"=> 4,
            "bathrooms"=> 2,
        ]);
        $response->assertStatus(201);
    }

    public function test_the_api_returns_200_delete_property():void
    {
        Property::factory()->create(
            [
                "title"=> "The Victoria",
                "price"=> 374662,
                "address"=> "81 Freshwater St, Torquay VIC 3228",
                "bedrooms"=> 4,
                "bathrooms"=> 2,
            ]
        );
        $response = $this->deleteJson("/api/properties/1");
        $response->assertStatus(200);
    }
    public function test_the_api_returns_200_update_property():void
    {
        Property::factory()->create(
            [
                "title"=> "The Victoria",
                "price"=> 374662,
                "address"=> "81 Freshwater St, Torquay VIC 3228",
                "bedrooms"=> 4,
                "bathrooms"=> 2,
            ]
        );
        $response = $this->putJson("/api/properties/1", [
            "title"=> "The New Victoria",
        ]);

        $response->assertStatus(200);
    }
}