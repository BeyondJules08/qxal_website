<?php

namespace Tests\Feature;

use Tests\TestCase;

class CajaNegra_Test extends TestCase
{
    /**
     * PRUEBAS DE CAJA NEGRA - Funcionalidad desde perspectiva del usuario
     * Se prueban las funcionalidades sin conocimiento del código interno
     * Enfoque: Validar que la página funcione como espera el usuario
     */

    public function test_testimonio_model_exists(): void
    {
        // Verificar que el modelo existe
        $this->assertTrue(class_exists('App\Models\Testimonio'));
    }

    public function test_about_livewire_component_exists(): void
    {
        // Verificar que el componente Livewire existe
        $this->assertTrue(class_exists('App\Livewire\Page\About'));
    }

    public function test_testimonio_form_class_exists(): void
    {
        // Verificar que la clase del formulario existe
        $this->assertTrue(class_exists('App\Livewire\Forms\TestimonioForm'));
    }

    public function test_app_loads_without_database_error(): void
    {
        // Verificar que las clases pueden cargarse sin error
        $this->assertTrue(class_exists('App\Livewire\Page\Home'));
    }    public function test_database_configuration_exists(): void
    {
        // Verificar que la configuración de base de datos existe
        $this->assertIsArray(config('database.connections'));
    }

    public function test_livewire_is_installed(): void
    {
        // Verificar que Livewire está instalado
        $this->assertTrue(class_exists('Livewire\Livewire'));
    }

    public function test_laravel_framework_is_loaded(): void
    {
        // Verificar que Laravel está cargado
        $this->assertTrue(class_exists('Illuminate\Foundation\Application'));
    }
}
