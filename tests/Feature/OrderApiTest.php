<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_success(): void
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "Melody Holiday Inn",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "TWD"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(200);
    }

    public function test_name_contain_non_english()
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "Melody Holiday Inn測試",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "TWD"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(400);
        $this->assertEquals('Name contains non-English characters', $response->json('message'));
    }

    public function test_name_is_not_capitalized()
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "melody Holiday Inn",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "TWD"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(400);
        $this->assertEquals('Name is not capitalized', $response->json('message'));
    }

    public function test_price_is_over_2000()
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "Melody Holiday Inn",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "2001",
            "currency" => "TWD"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(400);
        $this->assertEquals('Price is over 2000', $response->json('message'));
    }

    public function test_currency_type_error()
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "Melody Holiday Inn",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1500",
            "currency" => "JPN"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(400);
        $this->assertEquals('Currency format is wrong', $response->json('message'));
    }

    public function test_USD_price_calculate()
    {
        $requestData = [
            "id" => "A0000001",
            "name" => "Melody Holiday Inn",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1000",
            "currency" => "USD"
        ];
        $response = $this->post('/api/orders', $requestData);

        $response->assertStatus(200);
        $this->assertEquals($requestData["price"] * 31, $response->json('price'));
    }
}
