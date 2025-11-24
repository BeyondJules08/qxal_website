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
            'name'   => 'required|string|max:100',
            'role'   => 'required|string|max:100',
            'text'   => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }

    public function crear()
    {
        $this->validate();

        Testimonio::create([
            'name'   => $this->name,
            'role'   => $this->role,
            'text'   => $this->text,
            'rating' => $this->rating,
        ]);

        if ($this->rating >= 4) {
            $stats = \App\Models\Estadistica::firstOrCreate([], [
                'jugadores' => 0,
                'escuelas' => 0,
                'paises' => 0,
            ]);
            
            $stats->increment('jugadores');
        }

        $this->reset();
    }
}
