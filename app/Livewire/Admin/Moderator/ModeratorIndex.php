<?php

namespace App\Livewire\Admin\Moderator;

use App\Models\SchoolSession;
use App\Models\Stage;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ModeratorIndex extends Component
{
    use LivewireAlert, WithPagination;

    public $sessionId;
    public $stageId;
    public $search;
    public function render()
    {
        $moderators = User::moderator()
            ->where(function ($query) {
                $query->search('name', $this->search)->orSearch('email', $this->search);
            })
            ->when($this->stageId, function ($query) {
                $query->whereHas('stages', function ($query) {
                    $query->filterBy('id', $this->stageId);
                });
            })
            ->when($this->sessionId, function ($query) {
                $query->whereHas('stages', function ($query) {
                    $query->filterBy('school_session_id', $this->sessionId);
                });
            })
            ->oldest('name')
            ->paginate();
        $sessions = SchoolSession::latest()->get(['id', 'name']);
        $stages = Stage::latest()->get(['id', 'name']);

        return view('livewire.admin.moderator.moderator-index', compact('moderators', 'sessions', 'stages'))->title('All moderators');
    }

    public function delete($id): void
    {
        User::whereId($id)->delete();
        $this->alert('success', 'Moderator deleted successfully');
    }
}
