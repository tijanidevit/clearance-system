<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add students via csv file</h5>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent='store' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="session_id">Session</label>
                                <select class="form-control" id="session_id" wire:model.blur="session_id">
                                    <option value="" selected>Select a session</option>
                                    @forelse ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                    @empty
                                        <x-empty-table />
                                    @endforelse
                                </select>
                                <x-error-message record='session_id' />
                            </div>

                            <div class="form-group mb-3">

                                <label class="form-label" for="file">CSV File</label>
                                <a href="{{ '/StudentImport.csv' }}" download="StudentImport">Download Sample file</a>
                                <input type="file" wire:model.blur="file" accept=".csv" class="form-control"
                                    id="file" />
                                <x-error-message record='file' />

                                <div wire:loading wire:target="photo">Uploading...</div>
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
