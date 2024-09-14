<?php

namespace App\Livewire\Admin\Moderator;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ModeratorStore extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public function render()
    {
        return view('livewire.admin.moderator.moderator-store')->title('Add a new moderator');
    }

    public function rules() : array {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ];
    }

    public function store() : void {
        $data = $this->validate();
        $data['password'] = $this->email;
        $data['role'] = UserRoleEnum::MODERATOR->value;

        User::create($data);
        $this->reset();
        $this->alert('success', 'Moderator added successfully!');
    }
}
