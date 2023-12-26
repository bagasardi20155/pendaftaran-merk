@if (auth()->user()->email_verified_at)
    <div class="main-sidebar">
        <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="Pendaftaran Merk" width="50px"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="Pendaftaran Merk" width="30px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            {{-- administrator menus --}}
            @if (auth()->user()->hasRole('admin'))   
                <li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="far fa-chart-bar"></i> <span>Dashboard</span></a></li>
                <li class="nav-item dropdown {{ in_array($active, ['daftar-permohonan', 'merk-terdaftar', 'kelola-pengumuman']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder-open"></i><span>Permohonan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ $active == 'daftar-permohonan' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.daftar-permohonan.index') }}">Daftar Permohonan</a></li>
                        <li class="{{ $active == 'kelola-pengumuman' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.announcement.index') }}">Kelola Pengumuman</a></li>
                    </ul>
                </li>
                <li class="{{ $active == 'daftar-pengguna' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.daftar-pengguna.index') }}"><i class="far fa-list-alt"></i> <span>Daftar Pengguna</span></a></li>
            @endif
            {{-- ------- --}}

            {{-- applicant menus --}}
            @if (auth()->user()->hasRole('applicant'))   
            <li class="{{ $active == 'daftar-ajuan-merk' ? 'active' : '' }}"><a class="nav-link" href="{{ route('applicant.ajuan-merk.index') }}"><i class="fas fa-list"></i> <span>Daftar Ajuan</span></a></li>
                <li class="{{ $active == 'pengajuan-baru' ? 'active' : '' }}"><a class="nav-link" href="{{ route('applicant.pengajuan-baru.create') }}"><i class="far fa-flag"></i> <span>Pengajuan Baru</span></a></li>
            @endif
            {{-- ------- --}}
        </ul>    
        </aside>
    </div>
@endif