<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#">
            <img src="{{ url('assets') }}/images/icon/logo-white.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
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
                @role('admin')
                <li class="{{ request()->is('users/*') ? 'active' : '' }}">
                    <a class="js-arrow" href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i>User Management
                    </a>
                </li>
                @endrole
                <li class="{{ request()->is('projects/*') ? 'active' : '' }}">
                    <a class="js-arrow" href="{{ route('projects.index') }}">
                        <i class="fas fa-line-chart"></i>Project Management
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>