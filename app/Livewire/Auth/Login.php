<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{

    public $password , $name;

    public function login()
    {
        if(auth()->attempt(['name' => $this->name , 'password' => $this->password])) {
            return redirect()->route('index');
        }
        else{
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
