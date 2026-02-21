<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Login | Nafisa Mart')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email|max:255|exists:customers,email',
            'password' => 'required|string|min:6|max:255',
        ]);

        // Login logic goes here
        if (!auth('customer')->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Invalid credentials.');
            return;
        }

        return redirect()->intended();

    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
