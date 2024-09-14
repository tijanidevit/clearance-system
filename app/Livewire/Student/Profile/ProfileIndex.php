<?php

namespace App\Livewire\Student\Profile;

use App\Enums\ClearanceStatusEnum;
use App\Enums\StudentStatusEnum;
use App\Models\SchoolSession;
use App\Models\Stage;
use App\Models\StageStudent;
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
    public $moderatorStage;

    public function render()
    {
        $currentSession = SchoolSession::latest('name')->first();
        $this->sessionId = $this->sessionId ?? $currentSession?->id;

        $this->moderatorStage = $moderatorStage = Stage::where(['school_session_id' => $this->sessionId, 'moderator_id' => auth()->id()])->first();

        $students = [];

        if ($moderatorStage) {
            $students = Student::with([
                'user',
                'stageStudents' => function ($query) {
                    $query->where('stage_id', $this->moderatorStage->id)->latest();
                },
            ])
                ->where(function ($query) {
                    $query->when($this->search, function ($query) {
                        $query->search('matric_number', $this->search)->orWhereHas('user', function ($query) {
                            $query->search('email', $this->search)->orSearch('name', $this->search);
                        });
                    });
                })
                ->where(function ($query) {
                    $query->where('school_session_id', $this->sessionId);
                })
                ->latest()
                ->paginate();
        }
        $sessions = SchoolSession::latest('name')->get(['id', 'name']);
        return view('livewire.moderator.student.student-index', compact('students', 'sessions'))->title('Students');
    }

    public function approve($studentId) : void {
        StageStudent::create([
            'student_id' => $studentId,
            'stage_id' => $this->moderatorStage->id,
            'moderator_id' => auth()->id(),
            'status' => ClearanceStatusEnum::APPROVED->value,
        ]);

        $student = Student::find($studentId);

        $allStages = Stage::where('school_session_id', $this->sessionId)->count();
        $studentStages = $student->stageStudents()->whereHas('stage', function ($query) {
            $query->where('school_session_id', $this->sessionId);
        })->count();

        if ($allStages == $studentStages) {
            $student->status = StudentStatusEnum::COMPLETED->value;
        }
        else {
            $student->status = StudentStatusEnum::IN_PROGRESS->value;
        }
        $student->save();

        $this->alert('success', 'Student approved successfully');
    }

    public function decline($studentId) : void {
        StageStudent::create([
            'student_id' => $studentId,
            'stage_id' => $this->moderatorStage->id,
            'moderator_id' => auth()->id(),
            'status' => ClearanceStatusEnum::DECLINED->value,
        ]);
    }
}
