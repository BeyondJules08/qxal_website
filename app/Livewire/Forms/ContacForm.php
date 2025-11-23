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
            'name'    => 'required|string',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
    }

    public function save()
    {
        $this->validate();

        ContactMessage::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
    }
}
