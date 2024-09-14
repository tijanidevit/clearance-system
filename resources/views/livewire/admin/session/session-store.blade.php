<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Session details</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent='store' method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" wire:model.blur="name" aria-describedby="emailHelp" placeholder="{{ date('Y') . '/' . (date('Y') + 1) }}" />
                                    <x-error-message record='name' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="startsAt">Clearance Starts Date</label>
                                <input type="date" wire:model.blur="starts_at" class="form-control" id="startsAt" />
                                    <x-error-message record='starts_at' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="endsAt">Clearance Ends Date</label>
                                <input type="date" wire:model.blur="ends_at" class="form-control" id="endsAt" />
                                    <x-error-message record='ends_at' />
                            </div>
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
