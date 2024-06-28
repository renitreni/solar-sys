<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
#[Layout('components.layouts.auth')]
class LoginLivewire extends Component
{
    public $email;

    public $password;

    public $remember;

    public $errorMessage = null;

    public function render()
    {
        return view('livewire.login-livewire');
    }

    public function login()
    {
        $this->errorMessage = null;
        $this->validate([
            'email' => 'required|min:3',
            'password' => 'required|min:3',
        ]);

        $credentials = ['email' => $this->email, 'password' => $this->password];
        if (Auth::attempt($credentials, $this->remember)) {
            return redirect()->route('home');
        }

        $this->errorMessage = 'Email and Password credentials does not match.';
    }
}
