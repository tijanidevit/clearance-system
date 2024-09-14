<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>List of all students</h5>
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-8">
                        <input type="text" wire:model.live.debounce='search' name="search" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="sessionId" wire:model.live.debounce="sessionId">
                            <option value="" selected>All sessions</option>
                            @forelse ($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @empty
                                <x-empty-table />
                            @endforelse
                        </select>
                    </div>
                </div>
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
                                    <td>{{ ucwords($student->status) }}</td>
                                    <td>{{ $student->created_at->format('d M, Y') }}</td>
                                    <td><button class="btn btn-danger btn-sm" wire:click="delete({{ $student->id }})"
                                            wire:confirm='Are you sure you want to delete this student'>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <x-empty-table colspan="5" />
                            @endforelse
                        </tbody>
                    </table>

                    {{ $students->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
