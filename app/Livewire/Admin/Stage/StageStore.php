<?php

namespace App\Livewire\Admin\Stage;

use App\Models\SchoolSession;
use App\Models\Stage;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class StageStore extends Component
{
    use LivewireAlert, FileTrait, WithFileUploads;

    public $name;
    public $moderator_id;
    public $school_session_id;
    public $deadline;
    public $stamp;

    public function render()
    {
        $sessions = SchoolSession::oldest('name')->get(['id', 'name']);
        $moderators = User::moderator()->oldest('name')->get(['id', 'name']);
        return view('livewire.admin.stage.stage-store', compact('sessions', 'moderators'))->title('Add a new stage');
    }

    public function rules() : array {
        return [
            'name' => 'required|string',
            'moderator_id' => [
                'required',
                'exists:users,id',
                Rule::unique('stages')->where('school_session_id', $this->school_session_id)
            ],
            'school_session_id' => 'required|exists:school_sessions,id',
            'deadline' => 'required|date|after:today',
            'stamp' => 'required|file|mimes:png,jpeg,jpg',
        ];
    }

    public function store() : void {
        $data = $this->validate();
        $data['stamp'] = $this->uploadFile('clearance/stamp', $this->stamp);

        Stage::create($data);
        $this->reset();
        $this->alert('success', 'Stage added successfully!');
    }
}
