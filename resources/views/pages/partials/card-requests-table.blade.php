<table class="table table-bordered" id="table-1">
    <thead>
    <tr>
        <th>Date</th>
        <th>FormNo</th>
        <th>PG No</th>
        <th>Full Name</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td>{{ $record->created_at }}</td>
            <td>{{ $record->id }}</td>
            <td>{{ $record->emp_no }}</td>
            <td>{{ $record->full_name }}</td>
            <td>{{ $record->dept }}</td>
            <td>{{ $record->desig }}</td>
            <td>{{ $record->mobile }}</td>
            <td>@if($record->action=='pending' ) <span class="badge badge-secondary">{{$record->action}}</span>
                @elseif($record->action=='rejected')<span class="badge badge-danger">{{$record->action}}</span>
                @else <span class="badge badge-success">{{$record->action}}</span> @endif </td>

            @isset($action)
                <td><a href="{{route( $action, [$record->uuid, $record->app_id] )}}" role="button" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                        Details
                    </a>
                </td>
            @endisset

        </tr>
    @endforeach
    </tbody>
</table>
