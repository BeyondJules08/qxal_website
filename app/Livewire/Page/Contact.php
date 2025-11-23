<?php

namespace App\Livewire\Page;

use App\Livewire\Forms\ContacForm;
use Livewire\Component;

class Contact extends Component
{
    public ContacForm $form;

    public function send()
    {
        $this->form->save();

        session()->flash('success', '¡Mensaje guardado con éxito!');
    }
    public function render()
    {
        return view('livewire.page.contact');
    }
}
