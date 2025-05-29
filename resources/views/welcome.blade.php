@extends('layout')
@section('page', "Welcome Home")

@section('content')
<!-- PAGE CONTAINER-->
<div class="page-container2">
    <!-- HEADER DESKTOP-->
    @include('header')

    @include('mobile-sidebar')
    <!-- END HEADER DESKTOP-->

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @include('alerts')

                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left">
                                <span class="au-breadcrumb-span">You role is : <b>{{ strtoupper($user->role) }}</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->

    <!-- STATISTIC-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalUsers }}</h2>
                            <span class="desc">Total Users</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalAdmins }}</h2>
                            <span class="desc">Admin Users</span>
                            <div class="icon">
                                <i class="zmdi zmdi-badge-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalRegularUsers }}</h2>
                            <span class="desc">Regular Users</span>
                            <div class="icon">
                                <i class="zmdi zmdi-city"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalProjects }}</h2>
                            <span class="desc">Projects</span>
                            <div class="icon">
                                <i class="zmdi zmdi-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- RECENT REPORT 2-->
                        <div class="recent-report2">
                            <h3 class="title-3">recent reports</h3>
                            <div class="chart-info">
                                <div class="chart-info__left">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--green"></span>
                                        <span>Services</span>
                                    </div>
                                </div>
                                <div class="chart-info-right">
                                    <div class="rs-select2--dark rs-select2--md m-r-10">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">All Properties</option>
                                            <option value="">Products</option>
                                            <option value="">Services</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--dark rs-select2--sm">
                                        <select class="js-select2 au-select-dark" name="time">
                                            <option selected="selected">All Time</option>
                                            <option value="">By Month</option>
                                            <option value="">By Day</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-report__chart">
                                <canvas id="recent-rep2-chart"></canvas>
                            </div>
                        </div>
                        <!-- END RECENT REPORT 2             -->
                    </div>
                    <div class="col-xl-4">
                        <!-- TASK PROGRESS-->
                        <div class="task-progress">
                            <h3 class="title-3">Analytics</h3>
                            <div class="au-skill-container">
                                <div class="au-progress">
                                    <span class="au-progress__title">Users</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="90">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">Employees</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="85">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">Departments</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">Projects</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TASK PROGRESS-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection