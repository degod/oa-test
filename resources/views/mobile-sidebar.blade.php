<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="logo">
        <a href="#">
            <img src="{{ url('assets') }}/images/icon/logo-white.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="{{ url('assets') }}/images/icon/avatar-big-01.jpg" alt="John Doe" />
            </div>
            <h4 class="name">{{ $user->name }}</h4>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign out
            </a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="js-arrow" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li class="has-sub {{ (request()->routeIs('users.index') || request()->routeIs('users.edit')) ? 'active' : '' }}">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-users"></i>User Management
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="fas fa-user"></i>Users
                            </a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-id-badge"></i>Employees
                            </a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-building"></i>Departments</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-line-chart"></i>Project Management
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>