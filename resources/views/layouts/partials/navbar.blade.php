<nav class="navbar navbar-expand-lg main-navbar" style="top: 5px;">
    @if (auth()->user()->email_verified_at)
        <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        </form>
    @endif
    <ul class="navbar-nav navbar-right">
        @if (auth()->user()->email_verified_at)
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Pengumuman
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    {{-- get announcement --}}
                    @if (auth()->user()->hasRole('applicant'))
                        @foreach ($created as $data)    
                            @php
                                $announcement = explode("|", $data['announcement']);
                            @endphp
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon text-dark">
                                    <img class="rounded" src="{{ asset('admin/img/avatar/avatar-4.png') }}" alt="Admin" width="80%">
                                </div>
                                <div class="dropdown-item-desc">
                                    <div class="row">
                                        <div class="col-md-6"><h6>{{ $announcement[0] }}</h6></div>
                                        <div class="col-md-6"><b class="float-right">{{ \Carbon\Carbon::parse($data['updated_at'])->format('d-m-Y') }}</b></div>
                                    </div>
                                    <div class="time">{{ $announcement[1] }}</div>
                                </div>
                            </a>
                        @endforeach

                        @foreach ($generated as $item)
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon text-dark">
                                    <img class="rounded" src="{{ asset($item['logo']) }}" alt="Logo Brand" width="80%">
                                </div>
                                <div class="dropdown-item-desc">
                                    <div class="row">
                                        <div class="col-md-6"><h6>{{ $item['name'] }}</h6></div>
                                        <div class="col-md-6"><b class="float-right">{{ \Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}</b></div>
                                    </div>
                                    
                                    @if ($item->brand_status[0]->status == "waiting" || $item->brand_status[0]->status == "revision" || $item->brand_status[0]->status == "revised")
                                        <span class="badge badge-pill badge-warning" style="padding-top: 1px; padding-bottom: 1px">Proses Pengajuan</span>
                                    @elseif ($item->brand_status[0]->status == "rejected")
                                        <span class="badge badge-pill badge-danger" style="padding-top: 1px; padding-bottom: 1px">Merk Ditolak</span>
                                    @elseif ($item->brand_status[0]->status == "accepted")
                                        <span class="badge badge-pill badge-success" style="padding-top: 1px; padding-bottom: 1px">Merk Diterima</span>
                                    @endif
                                    <div class="time">{{ $item['address'] }}</div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        @foreach ($created as $data)    
                            @php
                                $announcement = explode("|", $data['announcement']);
                            @endphp
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon text-dark">
                                    <img class="rounded" src="{{ asset('admin/img/avatar/avatar-4.png') }}" alt="Admin" width="80%">
                                </div>
                                <div class="dropdown-item-desc">
                                    <div class="row">
                                        <div class="col-md-6"><h6>{{ $announcement[0] }}</h6></div>
                                        <div class="col-md-6"><b class="float-right">{{ \Carbon\Carbon::parse($data['updated_at'])->format('d-m-Y') }}</b></div>
                                    </div>
                                    <div class="time">{{ $announcement[1] }}</div>
                                </div>
                            </a>
                        @endforeach

                        @foreach ($generated as $item)
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon text-dark">
                                    <img class="rounded" src="{{ asset($item['logo']) }}" alt="Logo Brand" width="80%">
                                </div>
                                <div class="dropdown-item-desc">
                                    <div class="row">
                                        <div class="col-md-6"><h6>{{ $item['name'] }}</h6></div>
                                        <div class="col-md-6"><b class="float-right">{{ \Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}</b></div>
                                    </div>
                                    
                                    @if ($item->brand_status[0]->status == "waiting" || $item->brand_status[0]->status == "revision" || $item->brand_status[0]->status == "revised")
                                        <span class="badge badge-pill badge-warning" style="padding-top: 1px; padding-bottom: 1px">Proses Pengajuan</span>
                                    @elseif ($item->brand_status[0]->status == "rejected")
                                        <span class="badge badge-pill badge-danger" style="padding-top: 1px; padding-bottom: 1px">Merk Ditolak</span>
                                    @elseif ($item->brand_status[0]->status == "accepted")
                                        <span class="badge badge-pill badge-success" style="padding-top: 1px; padding-bottom: 1px">Merk Diterima</span>
                                    @endif
                                    <div class="time">{{ $item['address'] }}</div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="dropdown-footer text-center">
                    That's All <i class="fas fa-chevron-up"></i>
                </div>
                </div>
            </li>
        @endif
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('admin/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                @if (auth()->user()->email_verified_at)
                    <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="d-flex align-items-center dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i>Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>