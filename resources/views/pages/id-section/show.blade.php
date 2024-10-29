@extends('layouts.common')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Form {{$form->id}}: ID Section - ID Card Form Details</h4>
        </div>
        <div class="card-body">
            <form class="row g-3 mb-6" action="{{route( 'idsection.update', [$form->id])}}" method="post" enctype="multipart/form-data">
                @method('patch')
                @include('pages.partials.idsection-card-details-form')
            </form>

            <hr>

            <!-- Form Grid with Labels *************************-->
            <form class="row g-3 mb-6" action="{{route('idsection.store')}}" method="POST" enctype="multipart/form-data">
                @include('pages.partials.card-details-form')
            </form>
            <!-- END Form Grid with Labels -->
            {{--******************************************--}}
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImage = document.getElementById('preview_image');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Preview for Signature
        document.getElementById('sign').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewSignature = document.getElementById('preview_sign');
                    previewSignature.src = e.target.result;
                    previewSignature.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
