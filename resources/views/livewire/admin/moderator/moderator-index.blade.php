<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>List of all moderators</h5>
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-6 mb-2">
                        <input type="text" wire:model.live.debounce='search' name="search" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-control" id="stageId" wire:model.live.debounce="stageId">
                            <option value="" selected>All stages</option>
                            @forelse ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
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
                                <th>Email</th>
                                <th>Account created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($moderators as $moderator)
                                <tr>
                                    <td>{{$moderator->name}}</td>
                                    <td>{{$moderator->email}}</td>
                                    <td>{{$moderator->created_at->format('d M, Y')}}</td>
                                    <td><button class="btn btn-danger btn-sm" wire:click="delete({{$moderator->id}})" wire:confirm='Are you sure you want to delete this moderator'>Delete</button></td>
                                </tr>
                            @empty
                                <x-empty-table colspan="4" />
                            @endforelse
                        </tbody>
                    </table>

                    {{$moderators->links()}}
                </div>
            </div>

        </div>
    </div>
</div>
