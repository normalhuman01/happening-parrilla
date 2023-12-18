<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ErrorTest extends TestCase
{
    public function test_error(){

        $response = $this->get(route("error_page"));

        $response->assertStatus(200)
        ->assertViewIs("error");
    }
}
