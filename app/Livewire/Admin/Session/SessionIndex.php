<?php

namespace App\Livewire\Admin\Session;

use App\Models\SchoolSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SessionIndex extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public function render()
    {
        $sessions = SchoolSession::latest()->paginate();
        return view('livewire.admin.session.session-index', compact('sessions'))->title('All sessions');
    }

    public function delete($id) : void {
        SchoolSession::whereId($id)->delete();
        $this->alert('success', "Session deleted successfully");
    }
}
