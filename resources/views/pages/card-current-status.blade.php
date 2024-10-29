@extends('layouts.common')
@section('content')
    <div class="container">
        <div class="section">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Current Status</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="table-current-status">
                        <thead>
                        <tr>
                            <th>Form No</th>
                            <th>Emp No</th>
                            <th>Full Name</th>
                            <th>Desig</th>
                            <th>Desk</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $data)
                            <tr>
                                <td>{{ $data->form_no }}</td>
                                <td>{{ $data->emp_no }}</td>
                                <td>{{ $data->full_name }}</td>
                                <td>{{ $data->desig }}</td>
                                <td>{{ $data->stage_name }}</td>
                                <td>
                                    @if($data->action == 'pending')
                                        <span class="badge badge-dark">Pending</span>
                                    @elseif ($data->action == 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif ($data->action == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @else
                                        <span class="badge badge-primary">{{$data->action}}</span>
                                    @endif
                                </td>
                                <td>

                                    {{ $data->created_at }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script>
        $("#table-current-status").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2, 3] }
            ],
            order:[[6,"desc"]]
        });
    </script>
@endsection
