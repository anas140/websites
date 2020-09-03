<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function get_all_websites() {
        $response = $this->get('api/websites');
        $response->assertStatus(200);
    }

    /** @test */
    public function guest_can_create_a_website() {
        $data = [
            'name' => 'site name',
            'url' => 'https://google.com',
            'text' => 'text',
        ];
         //Send post request
        $response = $this->json('POST','api/websites',$data);
        //Assert it was successful
        $response->assertStatus(201);
    }
    

    /** @test */
    function website_is_not_created_if_validation_fails(){
        //Send post request
        $response = $this->json('POST','api/websites');
         //Assert it was successful
        $response->assertStatus(400);
    }

    /** @test */
    public function guest_can_update_a_website() {
        $data = [
            'name' => 'site name',
            'url' => 'https://google.com',
            'text' => 'text',
        ];
        $this->json('POST','api/websites',$data);
        $response = $this->json('PUT','api/websites/1',$data);
        $response->assertStatus(201);
    }

    /** @test */
    function website_is_not_updated_if_validation_fails(){
        $data = [
            'name' => 'site name',
            'url' => 'https://google.com',
            'text' => 'text',
        ];
        $this->json('POST','api/websites',$data);
        $response = $this->json('PUT','api/websites/1');
        $response->assertStatus(400);
    }

    /** @test */
    public function guest_can_delete_a_website() {
        $data = [
            'name' => 'site name',
            'url' => 'https://google.com',
            'text' => 'text',
        ];
        $this->json('POST','api/websites',$data);
        $response = $this->json('DELETE','api/websites/1');
        $response->assertStatus(204);
    }
    
}
