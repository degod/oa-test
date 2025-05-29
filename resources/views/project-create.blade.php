@extends('layout')

@section('page', "Project Create")
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
                                <div class="card-header">Create Project</div>
                                <div class="card-body card-block">
                                    <form action="{{ route('projects.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Title</div>
                                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                            </div>
                                            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Description</div>
                                                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                                            </div>
                                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Task</div>
                                                <input type="text" name="task" class="form-control" value="{{ old('task') }}">
                                            </div>
                                            @error('task') <div class="text-danger">{{ $message }}</div> @enderror
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