<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\ContactMessage;

class ContacForm extends Form
{
    public $name;
    public $email;
    public $subject;
    public $message;

    // Reglas de validación
    public function rules()
    {
        return [
            'name'    => 'required|string|min:3|max:50|regex:/^[\pL\pN\s\-\.\']+$/u',
            'email'   => 'required|email|max:50|lowercase',
            'subject' => 'required|string|min:5|max:20|not_regex:/^\s+$/',
            'message' => 'required|string|min:10|max:90|not_regex:/^\s+$/',
        ];
    }

    public function messages()
    {
        return [
            // Nombre            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede exceder 50 caracteres.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',
            // Email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.max' => 'El correo no puede exceder 50 caracteres.',
            'email.lowercase' => 'El correo debe estar en minúsculas.',
            // Asunto
            'subject.required' => 'El asunto es obligatorio.',
            'subject.string' => 'El asunto debe ser texto.',
            'subject.min' => 'El asunto debe tener al menos 5 caracteres.',
            'subject.max' => 'El asunto no puede exceder 20 caracteres.',
            'subject.not_regex' => 'El asunto no puede contener solo espacios en blanco.',
            // Mensaje
            'message.required' => 'El mensaje es obligatorio.',
            'message.string' => 'El mensaje debe ser texto.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje no puede exceder 90 caracteres.',
            'message.not_regex' => 'El mensaje no puede contener solo espacios en blanco.',
        ];
    }

    public function save()
    {
        $this->validate();

        // Limpiar y sanitizar datos antes de guardar
        $name = trim($this->name);
        $email = trim(strtolower($this->email));
        $subject = trim($this->subject);
        $message = trim($this->message);

        // Verificar nuevamente la longitud después de trimming
        if (strlen($name) < 3 || strlen($name) > 50) {
            throw new \Exception('Nombre inválido después de procesamiento.');
        }
        if (strlen($subject) < 5 || strlen($subject) > 20) {
            throw new \Exception('Asunto inválido después de procesamiento.');
        }
        if (strlen($message) < 10 || strlen($message) > 90) {
            throw new \Exception('Mensaje inválido después de procesamiento.');
        }

        ContactMessage::create([
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject,
            'message' => $message,
        ]);

        $this->reset();
    }
}
