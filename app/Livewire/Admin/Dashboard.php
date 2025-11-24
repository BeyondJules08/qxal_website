<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => \App\Models\Estadistica::first() ?? new \App\Models\Estadistica(['jugadores' => 0, 'escuelas' => 0, 'paises' => 0]),
            'reviews_count' => \App\Models\Testimonio::count(),
            'game_file' => \App\Models\GameFile::where('is_active', true)->first(),
        ])->layout('components.layouts.admin-layout');
    }
}
