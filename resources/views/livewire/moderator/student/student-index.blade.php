<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>List of all students</h5>
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-8">
                        <input type="text" wire:model.live.debounce='search' name="search" class="form-control"
                            placeholder="Search...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="sessionId" wire:model.live.debounce="sessionId">
                            <option value="" disabled selected>Select a session</option>
                            @forelse ($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @empty
                                <x-empty-table />
                            @endforelse
                        </select>
                    </div>
                </div>

                @if (!$moderatorStage)
                    <div class="alert alert-info mb-2">You were not assigned any stage</div>
                @else
                    <p class="mb-2">Assigned section: <strong>{{ $moderatorStage->name }}</strong></p>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Clearance status</th>
                                <th>Created on</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($students as $student)
                                @php
                                    $status = $student->stageStudents->first()->status ?? 'pending';
                                    $hasApproved = $status == 'approved';
                                    $color = match ($status) {
                                        'approved' => 'success',
                                        'declined' => 'danger',
                                        'pending' => 'secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <div>
                                            {{ $student->user->name }}
                                        </div>
                                        <div>
                                            {{ $student->matric_number }}
                                        </div>
                                    </td>
                                    <td>{{ $student->user->email }}</td>
                                    <td class="text-{{ $color }}">{{ ucwords($status) }}</td>
                                    <td>{{ $student->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @if (!$hasApproved)
                                            <button class="btn btn-success btn-sm"
                                                wire:click="approve({{ $student->id }})"
                                                wire:confirm='Are you sure you want to approve this student'>
                                                Approve
                                            </button>

                                            <button class="btn btn-danger btn-sm"
                                                wire:click="decline({{ $student->id }})"
                                                wire:confirm='Are you sure you want to decline this student'>
                                                Decline
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <x-empty-table colspan="5" />
                            @endforelse
                        </tbody>
                    </table>

                    @if (!is_array($students))
                        {{ $students->links() }}
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
