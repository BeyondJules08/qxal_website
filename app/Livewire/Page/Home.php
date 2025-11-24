<?php

namespace App\Livewire\Page;

use App\Models\Caracteristica;
use App\Models\Estadistica;
use App\Models\Testimonio;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.page.home',
            [
                'estadisticas' => Estadistica::first() ?? new Estadistica(['jugadores' => 0, 'escuelas' => 0, 'paises' => 0]),
                'caracteristicas' => Caracteristica::orderBy('title')->get(),
                'testimonios'=> Testimonio::orderBy('created_at','DESC')->get(),
            ]
            );
    }
}
