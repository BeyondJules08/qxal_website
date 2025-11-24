<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function authenticate()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! \Illuminate\Support\Facades\Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.app');
    }
}
