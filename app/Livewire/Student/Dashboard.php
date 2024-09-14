<?php

namespace App\Livewire\Student;

use App\Models\Stage;
use App\Models\StageStudent;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        $student = auth()->user()->student;
        $currentSessionId = $student->school_session_id;

        $stages = Stage::where(['school_session_id' => $currentSessionId])
            ->with([
                'stageStudents' => function ($query) use ($student) {
                    $query->where('student_id', $student->id)->with('moderator');
                },
            ])
            ->get();

        $approvedStages = StageStudent::where('student_id', $student->id)->approved()->with(['student', 'stage', 'moderator'])->get();

        return view('livewire.student.dashboard', compact('stages', 'approvedStages'))->title('Dashboard');
    }
}
