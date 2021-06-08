<?php

namespace Tests\Feature;

use App\Models\Holiday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicHolidayTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function holidays_can_be_retrieved_from_database(){

        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
