<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Stage details</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent='store' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" wire:model.blur="name"
                                    aria-describedby="name" placeholder="Library" />
                                <x-error-message record='name' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="moderator_id">Assigned moderator</label>
                                <select wire:model.blur="moderator_id" class="form-control" id="moderator_id">
                                    <option value="">Select a moderator</option>
                                    @forelse ($moderators as $moderator)
                                        <option value="{{ $moderator->id }}">{{ $moderator->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-error-message record='moderator_id' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="school_session_id">Session</label>
                                <select wire:model.blur="school_session_id" class="form-control" id="school_session_id">
                                    <option value="">Select a session</option>
                                    @forelse ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-error-message record='school_session_id' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="deadline">Clearance Deadline</label>
                                <input type="date" wire:model.blur="deadline" class="form-control" id="deadline" />
                                <x-error-message record='deadline' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="stamp">Clearance Stamp</label>
                                <input type="file" accept="image/*" wire:model.blur="stamp" class="form-control"
                                    id="stamp" />
                                <x-error-message record='stamp' />

                                <div wire:loading wire:target="stamp">Uploading...</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @if ($stamp)
                                <img src="{{ $stamp->temporaryUrl() }}" class="img-fluid" style="width: 120px">
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-4">
                        Submit
                        {{-- <x-loading /> --}}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
