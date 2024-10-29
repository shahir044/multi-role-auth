@extends('layouts.common')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>for Department Head - ID Card Form Details</h4>
        </div>
        <div class="card-body">
            <!-- Form Grid with Labels *************************-->
            <form class="row g-3 mb-6" action="{{route('deptapproval.store')}}" method="POST">
                @include('pages.partials.card-details-form')
            </form>
            <!-- END Form Grid with Labels -->
            {{--******************************************--}}
        </div>
    </div>
@endsection
