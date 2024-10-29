@extends('layouts.common')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Form {{$form->id}}: ID Section - ID Card Form Details</h4>
        </div>
        <div class="card-body">
            <!-- Form Grid with Labels *************************-->
            <form class="row g-3 mb-6">
                @method('patch')
                @include('pages.partials.idsection-card-details-form')
            </form>
            <hr>
            <form class="row g-3 mb-6" action="{{route('gmsecurity.store')}}" method="POST" enctype="multipart/form-data">
                @include('pages.partials.card-details-form')
            </form>

            <!-- END Form Grid with Labels -->
            {{--******************************************--}}
        </div>
    </div>
@endsection
