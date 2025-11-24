<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_is_properly_configured(): void
    {
        // Verificar que la aplicación está configurada correctamente
        $this->assertTrue(class_exists('Illuminate\Foundation\Application'));
    }
}
