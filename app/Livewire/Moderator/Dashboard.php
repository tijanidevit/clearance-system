<?php

namespace App\Livewire\Moderator;

use App\Models\SchoolSession;
use App\Models\Stage;
use App\Models\StageStudent;
use App\Models\Student;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentSessionId;
    public $selectedSession;
    public $totalStudents = 0;
    public $pendingStudents = 0;
    public $completedStudents = 0;
    public $moderatorStage;
    public $clearances = [];

    public function render()
    {
        $currentSession = SchoolSession::latest('name')->first();
        $this->currentSessionId = $this->currentSessionId ?? $currentSession?->id;
        $currentSessionId = $this->currentSessionId;

        $this->moderatorStage = $moderatorStage = Stage::where(['school_session_id' => $this->currentSessionId, 'moderator_id' => auth()->id()])->first();

        if ($moderatorStage) {
            $this->totalStudents = Student::where('school_session_id', $currentSessionId)->count();
            $this->completedStudents = StageStudent::where('stage_id', $moderatorStage->id)
                ->approved()
                ->count();
            $this->pendingStudents = $this->totalStudents - $this->completedStudents;

            $this->clearances = StageStudent::with('student')
                ->where('stage_id', $moderatorStage->id)
                ->approved()
                ->latest()
                ->limit(10)
                ->get();
        }

        $sessions = SchoolSession::latest('name')->get(['id', 'name']);

        return view('livewire.moderator.dashboard', compact('sessions'))->title('Dashboard ');
    }
}
