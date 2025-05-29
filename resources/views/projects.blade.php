@extends('layout')

@section('page', "Projects Management")
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
                    @include('alerts')

                    <a class="au-btn au-btn-icon au-btn--green mb-3" href="{{ route('projects.create') }}">
                        <i class="zmdi zmdi-plus"></i>add item</a>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-responsive-data2 mb-4">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Task</th>
                                            <th>date created</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                        <tr class="tr-shadow">
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>{{ $project->title }}</h6>
                                                    <span>
                                                        <a href="#">
                                                            <strong>By:</strong> {{ $project->user->name }}
                                                        </a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>{{ $project->description }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>{{ $project->task }}</h6>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($project->created_at)->format('F jS, Y g:i A') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('projects.edit', $project->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>

                                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                                            onclick="return confirm('Are you sure you want to DELETE?')">
                                                            <i class="zmdi zmdi-delete"></i>
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

                            {!! $projects->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection