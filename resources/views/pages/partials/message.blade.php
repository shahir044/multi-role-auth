@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            {!! implode('', $errors->all('<li class="text-white text-500">:message</li>')) !!}
        </ul>
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success alert-has-icon">
        <div class="alert-icon"><i class="far fa-check-circle"></i></div>
        <div class="alert-body">
            <div class="alert-title">{{ session()->get('success') }}</div>
        </div>
    </div>
    <hr>
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-check-circle"></i></div>
        <div class="alert-body">
            <div class="alert-title">Sorry! {{ session()->get('message') }}</div>
        </div>
    </div>
    <hr>
@endif
