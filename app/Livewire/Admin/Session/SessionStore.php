<?php

namespace App\Livewire\Admin\Session;

use App\Models\SchoolSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SessionStore extends Component
{
    use LivewireAlert;
    public $name;
    public $starts_at;
    public $ends_at;

    public function render()
    {
        return view('livewire.admin.session.session-store')->title('Create session');
    }


    public function rules() : array {
        return [
            'name' => 'required|string|unique:school_sessions',
            'starts_at' => 'required|date|after:today',
            'ends_at' => 'required|date|after:starts_at',
        ];
    }

    public function store() : void {
        $data = $this->validate();
        SchoolSession::create($data);
        $this->alert('success', 'Session added successfully!');
        $this->reset();
    }
}
