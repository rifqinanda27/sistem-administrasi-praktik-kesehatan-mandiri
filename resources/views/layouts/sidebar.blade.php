<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Header -->
    <li class="nav-header">MAIN MENU</li>

    <!-- Menu tanpa submenu -->
    <li class="nav-item">
        <a href="{{ url('home') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    @if(isset($user['role']['name']) && $user['role']['name'] === 'admin')
    <!-- Menu dengan submenu -->
    <li class="nav-item {{ in_array(Request::segment(1), ['users', 'roles']) ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ in_array(Request::segment(1), ['users', 'roles']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ url('users') }}" class="nav-link {{ Request::segment(1) == 'users' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('roles') }}" class="nav-link {{ Request::segment(1) == 'roles' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                </a>
            </li>
        </ul>
    </li>
    @elseif(isset($user['role']['name']) && $user['role']['name'] === 'dokterumum')
    <!-- Menu dengan submenu -->
    <li class="nav-item">
        <a href="{{ url('pasien') }}" class="nav-link {{ Request::segment(1) == 'pasien' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('tindakan') }}" class="nav-link {{ Request::segment(1) == 'tindakan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>Tindakan & Pemeriksaan</p>
        </a>
    </li>
    @endif
</ul>
