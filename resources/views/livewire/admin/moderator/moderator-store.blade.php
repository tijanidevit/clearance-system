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
                                <input type="text" class="form-control" id="name" wire:model.blur="name" placeholder="Aremu Faruk" />
                                    <x-error-message record='name' />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" wire:model.blur="email" class="form-control" id="email" />
                                    <x-error-message record='email' />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-4">
                        Submit
                        <x-loading />
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
