@extends('layouts.common')
@section('page-css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>I am admin cell</h4>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page-js')

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
@endsection
