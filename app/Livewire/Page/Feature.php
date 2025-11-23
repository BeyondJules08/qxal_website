<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Caracteristica;

class Feature extends Component
{
    public function render()
    {
        return view('livewire.page.feature',[
            'caracteristicas' => Caracteristica::orderBy('title')->get(),

        ]);
    }
}
