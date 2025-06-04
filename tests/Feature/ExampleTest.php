<?php

declare(strict_types=1);

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $testResponse = $this->get('/');

        $testResponse->assertStatus(302);

        $testResponse->assertRedirect('/admin');

        $this->assertTrue(true);
    }
}
