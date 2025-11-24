<?php

namespace App\Livewire\Forms;

use App\Models\Testimonio;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TestimonioForm extends Form
{
    public $name;
    public $role;
    public $text;
    public $rating;

    public function rules()
    {
        return [
            'name'   => 'required|string|min:3|max:20|regex:/^[\pL\pN\s\-\.\']+$/u',
            'role'   => 'required|string|min:3|max:20|regex:/^[\pL\pN\s\-\.\']+$/u',
            'text'   => 'required|string|min:10|max:50|not_regex:/^\s+$/',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }

    public function messages()
    {
        return [
            // Nombre
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede exceder 20 caracteres.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',

            // Rol
            'role.required' => 'El rol/profesión es obligatorio.',
            'role.string' => 'El rol debe ser texto.',
            'role.min' => 'El rol debe tener al menos 3 caracteres.',
            'role.max' => 'El rol no puede exceder 20 caracteres.',
            'role.regex' => 'El rol contiene caracteres no permitidos.',

            // Texto/Comentario
            'text.required' => 'El comentario es obligatorio.',
            'text.string' => 'El comentario debe ser texto.',
            'text.min' => 'El comentario debe tener al menos 10 caracteres.',
            'text.max' => 'El comentario no puede exceder 50 caracteres.',
            'text.not_regex' => 'El comentario no puede contener solo espacios en blanco.',

            // Rating
            'rating.required' => 'Debes seleccionar una calificación de estrellas.',
            'rating.integer' => 'La calificación debe ser un número.',
            'rating.min' => 'La calificación mínima es 1 estrella.',
            'rating.max' => 'La calificación máxima es 5 estrellas.',
        ];
    }

    public function crear()
    {
        $this->validate();

        // Limpiar y sanitizar datos antes de guardar
        $name = trim($this->name);
        $role = trim($this->role);
        $text = trim($this->text);
        $rating = (int)$this->rating;

        // Verificar nuevamente la longitud después de trimming
        if (strlen($name) < 3 || strlen($name) > 20) {
            throw new \Exception('Nombre inválido después de procesamiento.');
        }
        if (strlen($role) < 3 || strlen($role) > 20) {
            throw new \Exception('Rol inválido después de procesamiento.');
        }
        if (strlen($text) < 10 || strlen($text) > 50) {
            throw new \Exception('Comentario inválido después de procesamiento. No puede superar 50 caracteres.');
        }
        if ($rating < 1 || $rating > 5) {
            throw new \Exception('Calificación inválida después de procesamiento.');
        }

        Testimonio::create([
            'name'   => $name,
            'role'   => $role,
            'text'   => $text,
            'rating' => $rating,
        ]);

        $this->reset();
    }
}
