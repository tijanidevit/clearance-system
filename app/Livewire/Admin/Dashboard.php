<?php

namespace App\Livewire\Admin;

use App\Models\SchoolSession;
use App\Models\StageStudent;
use App\Models\Student;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentSessionId;
    public $selectedSession;
    public $pendingClearance;
    public $inProgressClearance;
    public $completedClearance;
    public $clearances;

    public function render()
    {
        $currentSession = SchoolSession::latest('name')->first();
        $this->currentSessionId = $this->currentSessionId ?? $currentSession?->id;
        $currentSessionId = $this->currentSessionId;

        $this->pendingClearance = Student::where('school_session_id', $currentSessionId)->pending()->count();
        $this->inProgressClearance = Student::where('school_session_id', $currentSessionId)->inProgress()->count();
        $this->completedClearance = Student::where('school_session_id', $currentSessionId)->completed()->count();

        $sessions = SchoolSession::latest('name')->get(['id', 'name']);

        $this->clearances = StageStudent::with('student', 'stage')
            ->whereHas('student', function ($query) use ($currentSessionId) {
                $query->where('school_session_id', $currentSessionId);
            })
            ->approved()
            ->latest()
            ->limit(10)
            ->get();

            logger("Current session ID is " . $this->currentSessionId);
            logger("Current inProgressClearance is " . $this->inProgressClearance);

        return view('livewire.admin.dashboard', compact('sessions'))->title("Dashboard ");
    }

    public function setSelectedSession() : void {
        $this->selectedSession = SchoolSession::filterBy('id', $this->currentSessionId)->first()->name;
    }
}
