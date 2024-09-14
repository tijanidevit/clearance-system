<div class='row'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>List of all sessions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Clearance Starts at</th>
                                <th>Clearance Ends at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sessions as $session)
                                <tr>
                                    <td>{{$session->name}}</td>
                                    <td>{{$session->starts_at->format('d M, Y')}}</td>
                                    <td>{{$session->ends_at->format('d M, Y')}}</td>
                                    <td><button class="btn btn-danger btn-sm" wire:click="delete({{$session->id}})" wire:confirm='Are you sure you want to delete this session'>Delete</button></td>
                                </tr>
                            @empty
                                <x-empty-table colspan="3" />
                            @endforelse
                        </tbody>
                    </table>

                    {{$sessions->links()}}
                </div>
            </div>

        </div>
    </div>
</div>
