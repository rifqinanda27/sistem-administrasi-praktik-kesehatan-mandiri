<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Header -->
    <li class="nav-header">MAIN MENU</li>

    @if(isset($user['role']['name']) && $user['role']['name'] === 'admin')
    <!-- Menu tanpa submenu -->
    <li class="nav-item">
        <a href="{{ url('home') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <!-- Menu dengan submenu -->
    <li class="nav-item {{ in_array(Request::segment(1), ['users', 'roles', 'dokter']) ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ in_array(Request::segment(1), ['users', 'roles', 'dokter']) ? 'active' : '' }}">
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
            <li class="nav-item">
                <a href="{{ url('dokter') }}" class="nav-link {{ Request::segment(1) == 'dokter' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dokter</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{ url('pengaturan') }}" class="nav-link {{ Request::segment(1) == 'pengaturan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Pengaturan</p>
        </a>
    </li>
    @elseif(isset($user['role']['name']) && $user['role']['name'] === 'dokterumum')
    <!-- Menu dengan submenu -->
    <li class="nav-item">
        <a href="{{ url('tindakan') }}" class="nav-link {{ Request::segment(1) == 'tindakan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>Tindakan & Pemeriksaan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('pasien') }}" class="nav-link {{ Request::segment(1) == 'pasien' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Pasien</p>
        </a>
    </li>
    @elseif(isset($user['role']['name']) && $user['role']['name'] === 'resepsionis')
    <!-- Menu dengan submenu -->
    <li class="nav-item">
        <a href="{{ url('pasien-resepsionis') }}" class="nav-link {{ Request::segment(1) == 'pasien-resepsionis' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('kunjungan-pasien') }}" class="nav-link {{ Request::segment(1) == 'kunjungan-pasien' ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Kunjungan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('lab-pasien') }}" class="nav-link {{ Request::segment(1) == 'lab-pasien' ? 'active' : '' }}">
            <i class="nav-icon fas fa-flask"></i>
            <p>Laboratorium</p>
        </a>
    </li>
    @elseif(isset($user['role']['name']) && $user['role']['name'] === 'apoteker')
    <!-- Menu dengan submenu -->
    <li class="nav-item">
        <a href="{{ url('resep') }}" class="nav-link {{ Request::segment(1) == 'resep' ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard"></i>
            <p>Resep Obat</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('obat') }}" class="nav-link {{ Request::segment(1) == 'obat' ? 'active' : '' }}">
            <i class="nav-icon fas fa-pills"></i>
            <p>Obat</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('instruksi') }}" class="nav-link {{ Request::segment(1) == 'instruksi' ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Intruksi Resep</p>
        </a>
    </li>
    @elseif(isset($user['role']['name']) && $user['role']['name'] === 'kasir')
    <li class="nav-item">
        <a href="{{ url('pembayaran') }}" class="nav-link {{ Request::segment(1) == 'pembayaran' ? 'active' : '' }}">
            <i class="nav-icon fas fa-receipt"></i>
            <p>Pembayaran</p>
        </a>
    </li>
    @endif
</ul>
