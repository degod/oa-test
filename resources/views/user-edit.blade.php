@extends('layout')

@section('page', "User Edit")
@section('content')

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    @include('header')
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    @include('mobile-sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">Update <strong>{{ $user->name }}</strong> Information</div>
                                <div class="card-body card-block">
                                    <form action="{{ route('users.update', ['uuid'=>$user->id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Name</div>
                                                <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name }}">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Email</div>
                                                <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Role</div>
                                                <select name="role" class="form-control">
                                                    <option value="admin" {{ ((old('role') ?? $user->role)=='admin') ? 'selected': '' }}>Admin</option>
                                                    <option value="user" {{ ((old('role') ?? $user->role)=='user') ? 'selected': '' }}>User</option>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-asterisk"></i>
                                                </div>
                                            </div>
                                            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Is Active</div>
                                                <select name="is_active" class="form-control">
                                                    <option value="1" {{ ((old('is_active') ?? $user->is_active)==1) ? 'selected': '' }}>Yes</option>
                                                    <option value="0" {{ ((old('is_active') ?? $user->is_active)==0) ? 'selected': '' }}>No</option>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-asterisk"></i>
                                                </div>
                                            </div>
                                            @error('is_active') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-actions form-group">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection