@extends('layout')

@section('page', "Users Management")
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
                    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $filters['name'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $filters['email'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-control">
                                    <option value="">--Role--</option>
                                    <option value="admin" {{ ($filters['role'] ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ ($filters['role'] ?? '') === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-responsive-data2 mb-4">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>user</th>
                                            <th>role</th>
                                            <th>status</th>
                                            <th>date created</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $usr)
                                        <tr class="tr-shadow">
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>{{ $usr->name }}</h6>
                                                    <span>
                                                        <a href="#">{{ $usr->email }}</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="role {{ $usr->role }}">{{ $usr->role }}</span>
                                            </td>
                                            <td class="{{ $usr->is_active ? 'process': 'denied' }}">
                                                {{ $usr->is_active ? 'Active': 'Inactive' }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($usr->created_at)->format('l, F jS, Y g:i A') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('users.edit', ['uuid'=>$usr->id]) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>

                                                    <form action="{{ route('users.toggle', $usr->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="{{ $usr->is_active ? 'De-activate': 'Activate' }}">
                                                            @if($usr->is_active)
                                                            <i class="zmdi zmdi-delete"></i>
                                                            @else
                                                            <i class="zmdi zmdi-undo"></i>
                                                            @endif
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->

                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection