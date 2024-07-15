@extends('role-permission.layouts.app')

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css')}}">
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Role : {{ $role->name }}
                            <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <h6>Permissions</h6>

                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-2 m-2 pretty p-icon p-smooth">
                                            <input type="checkbox"
                                                   name="permission[]"
                                                   value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            <div class="state p-success">
                                                <i class="icon fa fa-check"></i>
                                                <label>{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-2">
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                                />
                                                {{ $permission->name }}
                                            </label>
                                        </div>--}}
                                    @endforeach
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
