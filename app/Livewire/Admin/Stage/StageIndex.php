<?php

namespace App\Livewire\Admin\Stage;

use App\Models\SchoolSession;
use App\Models\Stage;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class StageIndex extends Component
{
    use LivewireAlert, WithPagination;

    public $sessionId;
    public $moderatorId;
    public $search;
    public function render()
    {
        $stages = Stage::with('session', 'moderator')->where(function ($query) {
            $query->search('name', $this->search);
        })
            ->when($this->moderatorId, function ($query) {
                $query->whereHas('moderator', function ($query) {
                    $query->filterBy('id', $this->moderatorId);
                });
            })
            ->when($this->sessionId, function ($query) {
                $query->filterBy('school_session_id', $this->sessionId);
            })
            ->oldest('name')
            ->paginate();

        $sessions = SchoolSession::latest()->get(['id', 'name']);
        $moderators = User::moderator()->latest()->get(['id', 'name']);

        return view('livewire.admin.stage.stage-index', compact('stages', 'sessions', 'moderators'))->title('All stages');
    }

    public function delete($id): void
    {
        Stage::whereId($id)->delete();
        $this->alert('success', 'Stage deleted successfully');
    }
}
