@extends('layouts.common')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Create User
                            <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">PG No</label>
                                <input type="text" name="pg_no" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Designation</label><span class="text-danger">*</span>
                                <select class="form-control" name="desig" select2 required>
                                    @foreach ($desgs as $desg)
                                        <option value="{{$desg->name}}">{{$desg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Department</label><span class="text-danger">*</span>
                                <select class="form-control" id="dept" name="dept" select2 required>
                                    @foreach ($depts as $dept)
                                        <option value="{{$dept->name}}">{{$dept->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Mobile Number (11 Digit)</label><span class="text-danger">*</span>
                                <input id="mobile" name="mobile" type="text" minlength="11"
                                       maxlength="11" placeholder="017xxx" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>National ID Card no.</label><span class="text-danger">*</span>
                                <input id="nid" name="nid" type="number" placeholder="" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" class="form-control select2" multiple="multiple">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
