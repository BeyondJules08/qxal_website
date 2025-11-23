<?php

namespace App\Livewire\Page;

use App\Livewire\Forms\TestimonioForm;
use App\Models\Testimonio;
use Livewire\Component;
use Livewire\WithPagination;

class About extends Component
{
        // Para que no se rompa el estilo al cambiar de página
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
        public TestimonioForm $form;
public function updatedPage()
{
    $this->dispatch('scrollToTestimonios');
}

    public function save()
    {
        $this->form->crear();

        session()->flash('success', '¡Comentario enviado correctamente!');

        // Reiniciar a la primera página tras guardar
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.page.about',[
            'testimonios' => Testimonio::latest()->paginate(5),
        ]);
    }
}
