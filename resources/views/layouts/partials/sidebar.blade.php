@if (auth()->user()->email_verified_at)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo_ki2.png') }}" alt="Pendaftaran Merk" width="50px"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo_ki2.png') }}" alt="Pendaftaran Merk" width="30px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            {{-- administrator menus --}}
            @if (auth()->user()->hasRole('admin'))   
                <li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="#"><i class="far fa-chart-bar"></i> <span>Dashboard</span></a></li>
                <li class="nav-item dropdown {{ in_array($active, ['daftar-permohonan', 'merk-terdaftar', 'kelola-pengumuman']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder-open"></i><span>Permohonan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ $active == 'daftar-permohonan' ? 'active' : '' }}"><a class="nav-link" href="#">Daftar Permohonan</a></li>
                        <li class="{{ $active == 'merk-terdaftar' ? 'active' : '' }}"><a class="nav-link" href="#">Merk Terdaftar</a></li>
                        <li class="{{ $active == 'kelola-pengumuman' ? 'active' : '' }}"><a class="nav-link" href="#">Kelola Pengumuman</a></li>
                    </ul>
                </li>
                <li class="{{ $active == 'daftar-pengguna' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.daftar-pengguna.index') }}"><i class="far fa-list-alt"></i> <span>Daftar Pengguna</span></a></li>
            @endif
            {{-- ------- --}}

            {{-- applicant menus --}}
            @if (auth()->user()->hasRole('applicant'))   
                <li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="#"><i class="far fa-chart-bar"></i> <span>Dashboard</span></a></li>
                <li class="nav-item dropdown {{ in_array($active, ['daftar-ajuan-merk', 'pengajuan-baru']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-flag"></i><span>Pengajuan Merk</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ $active == 'daftar-ajuan-merk' ? 'active' : '' }}"><a class="nav-link" href="{{ route('applicant.ajuan-merk.index') }}">Daftar Ajuan Merk</a></li>
                        <li class="{{ $active == 'pengajuan-baru' ? 'active' : '' }}"><a class="nav-link" href="{{ route('applicant.pengajuan-baru.create') }}">Pengajuan Baru</a></li>
                    </ul>
                </li>
            @endif
            {{-- ------- --}}
        </ul>    
        </aside>
    </div>
@endif