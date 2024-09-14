<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>List of all stages</h5>
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-6 mb-2">
                        <input type="text" wire:model.live.debounce='search' name="search" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-control" id="moderatorId" wire:model.live.debounce="moderatorId">
                            <option value="" selected>All moderators</option>
                            @forelse ($moderators as $moderator)
                                <option value="{{ $moderator->id }}">{{ $moderator->name }}</option>
                            @empty
                                <x-empty-table />
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
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
                                <th>Assigned moderator</th>
                                <th>Session</th>
                                <th>Deadline</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($stages as $stage)
                                <tr>
                                    <td>{{$stage->name}}</td>
                                    <td>{{$stage->moderator?->name}}</td>
                                    <td>{{$stage->session?->name}}</td>
                                    <td>{{$stage->deadline->format('d M, Y')}}</td>
                                    <td><button class="btn btn-danger btn-sm" wire:click="delete({{$stage->id}})" wire:confirm='Are you sure you want to delete this stage'>Delete</button></td>
                                </tr>
                            @empty
                                <x-empty-table colspan="5" />
                            @endforelse
                        </tbody>
                    </table>

                    {{$stages->links()}}
                </div>
            </div>

        </div>
    </div>
</div>
