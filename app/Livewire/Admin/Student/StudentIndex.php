<?php

namespace App\Livewire\Admin\Student;

use App\Models\SchoolSession;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class StudentIndex extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $sessionId;
    public $search;

    public function render()
    {
        $students = Student::with('user')
            ->where(function ($query) {
                $query->when($this->search, function ($query) {
                    $query->search('matric_number', $this->search)->orWhereHas('user', function ($query) {
                        $query->search('email', $this->search)->orSearch('name', $this->search);
                    });
                });
            })
            ->filterBy('school_session_id', $this->sessionId)
            ->latest()
            ->paginate();
        $sessions = SchoolSession::latest()->get(['id', 'name']);
        return view('livewire.admin.student.student-index', compact('students', 'sessions'))->title('All students');
    }

    public function delete($id): void
    {
        $student = Student::whereId($id)->first();

        $student->user()->delete();
        $student->delete();
        $this->alert('success', 'Student deleted successfully');
    }
}
