<?php

namespace App\Livewire\Admin\Student;

use App\Imports\StudentsImport;
use App\Models\SchoolSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class StudentStore extends Component
{
    use WithFileUploads, LivewireAlert;

    public $file;
    public $session_id;

    public function render()
    {
        $sessions = SchoolSession::latest()->get(['id', 'name']);
        return view('livewire.admin.student.student-store', compact('sessions'))->title('Add students');
    }

    public function rules() : array {
        return [
            'session_id' => 'required|string|exists:school_sessions,id',
            'file' => 'required|file|mimes:csv',
        ];
    }

    public function store() : void {
        $data = $this->validate();

        Excel::import(new StudentsImport($data['session_id']), $this->file->getRealPath());
        $this->reset();

        $this->alert('success', 'Student imported successfully!');

        $this->redirectRoute('admin.student.index');
    }

}
