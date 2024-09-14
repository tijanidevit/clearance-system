<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email;
    public string $password;

    #[Layout('auth-layout.app')]
    public function render()
    {
        return view('livewire.login');
    }

    public function rules() : array {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|string',
        ];
    }

    public function messages() : array {
        return [
            'email.exists' => 'A user with this email does not exist',
        ];
    }

    public function login() {
        $data = $this->validate();

        if (Auth::attempt($data)) {
            if (auth()->user()->isAdmin()) {
                return $this->redirect(route('admin.dashboard'));
            }
            elseif (auth()->user()->isModerator()) {
                return $this->redirect(route('moderator.dashboard'));
            }
            else{
                return $this->redirect(route('student.dashboard'));
            }
        }
        else {
            $this->addError('password', 'Incorrect Password');
        }
    }
}
