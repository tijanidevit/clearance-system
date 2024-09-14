@section('title-extra')
    <div class="ml-2">{{ $selectedSession }}</div>
@endsection
<div>
    <div class="d-flex justify-content-end">
        <div style="width: 20%">
            <select class="form-control mb-2" wire:model.live.debounce='currentSessionId'
                id="currentSessionId">
                <option value="" disabled selected>Select a session</option>
                @forelse ($sessions as $session)
                    <option @selected($session->id == $currentSessionId) value="{{ $session->id }}">{{ $session->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="row">
        @if (!$moderatorStage)
            <div class="alert alert-info mb-2">You were not assigned any stage</div>
        @else
            <p class="mb-2">Assigned section: <strong>{{$moderatorStage->name}}</strong></p>
        @endif
        <div class="col-md-4 col-sm-6">
            <div class="card statistics-card-1 overflow-hidden">
                <div class="card-body">
                    <img src="/assets/images/widget/img-status-5.svg" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4">Total Students</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card statistics-card-1 overflow-hidden">
                <div class="card-body">
                    <img src="/assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4">Pending Students</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $pendingStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card statistics-card-1 overflow-hidden bg-brand-color-3">
                <div class="card-body">
                    <img src="/assets/images/widget/img-status-6.svg" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4 text-white">Completed Students</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">{{ $completedStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5>Recent Clearance</h5>
                </div>
                <div class="card-body py-2 px-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless table-sm mb-0">
                            <tbody>

                                @forelse ($clearances as $clearance)
                                @empty
                                    <x-empty-table colspan="3" />
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
