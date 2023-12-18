<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestauranteTest extends TestCase
{
    public function test_main(){
        
        $response = $this->get(route("main"));


        $response->assertStatus(200)
        ->assertViewIs("main");
    }
}
