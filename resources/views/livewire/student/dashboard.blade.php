<div>
    <div class="row">

        @forelse ($stages as $stage)
            @php
                $lastStageStudent = $stage
                    ->stageStudents()
                    ->where('student_id', auth()->user()->student->id)
                    ->latest()
                    ->first();
                $lastStatus = $lastStageStudent?->status ?? 'pending';
                $isApproved = $lastStatus == 'approved';

                $approvedBy = $stage->moderator?->name;

                $color = match ($lastStatus) {
                    'approved' => 'bg-brand-color-3',
                    'declined' => 'danger',
                    'pending' => 'secondary',
                };

            @endphp
            <div class="col-12">
                <div class="card statistics-card-1 overflow-hidden {{ $color }}">
                    <div class="card-body">
                        <img src="/assets/images/widget/img-status-5.svg" alt="img" class="img-fluid img-bg" />
                        <h5 class="mb-4">{{ $stage->name }}</h5>
                        <div class="d-flex align-items-center mt-3">
                            <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ ucwords($lastStatus) }}</h3>
                        </div>


                        @if ($lastStatus != 'pending')
                            <div class="d-flex justify-content-between w-100">
                                <p>{{ ucwords($lastStatus) }} by: {{ $approvedBy }}</p>
                                <p>{{ ucwords($lastStatus) }} on: {{ $lastStageStudent->created_at->format('d M, y') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                You do not have any clearance to perform yet!
            </div>
        @endforelse


        <div class="mt-2">

            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->student->status == 'completed')
                        <div class="my-3">
                            <h4>Hurray!!! 👏🏽👏🏽👏🏽</h4>
                            <p>You have completed your clearance</p>
                        </div>
                        <div class="container" id="stamp">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <p><strong>{{ auth()->user()->name }}</strong></p>
                                        <p><strong>{{ auth()->user()->student->matric_number }}</strong></p>
                                    </div>
                                </div>
                                @forelse ($approvedStages as $stage)
                                    <div class="col-6 mb-5">
                                        <div class="stamp-container" style="position: relative; display: inline-block;">

                                            <img src="{{ $stage->stage->stamp }}" alt="Stamp" class="img-fluid"
                                                style="max-width: 100%; height: auto;">

                                            <div class="overlay-text"
                                                style="position: absolute; bottom: 10px; left: 10px; color: white; background-color: rgba(0, 0, 0, 0.5); padding: 5px 20px; border-radius: 5px;">
                                                <strong>{{ $stage->moderator->name }}</strong><br>
                                                <strong>{{ $stage->stage->name }}</strong><br>
                                                <small>{{ $stage->created_at->format('d/m/y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No stages found.</p>
                                @endforelse
                            </div>
                        </div>

                        <button onclick="printStamp()" class="btn btn-dark my-3"> Print Clearance Slip</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@section('extra-scripts')
    <script>
        function printStamp(stampId) {
            var printContents = document.getElementById('stamp').innerHTML;
            var originalContents = document.body.innerHTML;

            // Replace the body content with the stamp content and print it
            document.body.innerHTML = printContents;
            window.print();

            // Restore the original content after printing
            document.body.innerHTML = originalContents;
            window.location.reload(); // Refresh to reload the Livewire component properly
        }
    </script>
@endsection
