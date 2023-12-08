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
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">General Dashboard</a></li>
                <li><a class="nav-link" href="#">Ecommerce Dashboard</a></li>
            </ul>
            </li>
            <li><a class="nav-link" href="#"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            {{-- ------- --}}
        </ul>    
        </aside>
    </div>
@endif