<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Student;
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
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages() : array {
        return [
            'email.exists' => 'A user with this email or matric number does not exist',
        ];
    }

    public function login() {
        $data = $this->validate();
        $isEmail = filter_var($data['email'], FILTER_VALIDATE_EMAIL);

        $user = $isEmail
            ? User::where('email', $data['email'])->first()
            : Student::where('matric_number', $data['email'])->first()?->user;


        if (!$user) {
            $message = $isEmail ? "Email" : "Matric Number";
            $this->addError('email', "Incorrect $message");
            return;
        }

        if ($user && Auth::attempt(['email' => $user->email, 'password' => $data['password']])) {
            if ($user->isAdmin()) {
                return $this->redirect(route('admin.dashboard'));
            } elseif ($user->isModerator()) {
                return $this->redirect(route('moderator.dashboard'));
            } else {
                return $this->redirect(route('student.dashboard'));
            }
        } else {
            $this->addError('password', 'Incorrect Password');
        }
    }
}
