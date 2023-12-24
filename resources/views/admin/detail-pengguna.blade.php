@extends('layouts.master')

@section('title', 'Detail Pengguna')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #000;
        }

        .separator:not(:empty)::before {
            margin-right: .25em;
        }

        .separator:not(:empty)::after {
            margin-left: .25em;
        }
    </style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.daftar-pengguna.index') }}">Daftar Pengguna</a></div>
                <div class="breadcrumb-item">Detail User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-dark">
                                        Informasi Profile
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Useer account's profile information and email address.
                                    </p>
                                </header>
                                <div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input id="name" type="name" class="form-control" name="name" tabindex="1" value="{{ $data->name }}" disabled autofocus autocomplete="name">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mb-4" >
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        
                                <div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ $data->email }}" disabled autofocus autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mb-4" >
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </section>                            
                        </div>
                    </div>
                </div>
                @if (count($brands) > 0)    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-dark">
                                            Brand(s) by User
                                        </h2>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Brands applied by user
                                        </p>
                                    </header>
                                    <div>
                                        <div class="table-responsive" style="max-height: 191px">
                                            <table class="table table-striped" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Brand</th>
                                                        <th>Owner</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($brands) > 0 || $brands != null)
                                                        @foreach ($brands as $brand)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $brand->name }}</td>
                                                                <td>{{ $brand->owner }}</td>
                                                                <td>
                                                                    @if ( $brand->brand_status[0]->status == 'waiting')
                                                                        <span class="badge badge-pill badge-dark" title="Menunggu Verifikasi Admin">{{ $brand->brand_status[0]->status }}</span>
                                                                    @elseif ( $brand->brand_status[0]->status == 'accepted')
                                                                        <span class="badge badge-pill badge-success" title="Merk Anda Diterima Admin">{{ $brand->brand_status[0]->status }}</span>
                                                                    @elseif ( $brand->brand_status[0]->status == 'revision' || $brand->brand_status[0]->status == 'revised' )
                                                                        <span class="badge badge-pill badge-warning" title="Ajuan Merk perlu Direvisi">{{ $brand->brand_status[0]->status }}</span>
                                                                    @elseif ( $brand->brand_status[0]->status == 'rejected')
                                                                        <span class="badge badge-pill badge-danger" title="Merk Anda Ditolak Admin">{{ $brand->brand_status[0]->status }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.daftar-permohonan.detail', ['brand' => $brand->id]) }}" class="btn btn-warning" title="Detail & Verifikasi"><i class="fas fa-pencil-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach    
                                                    @else    
                                                        <td colspan="6" class="text-center">Tidak ada data yang ditemukan</td>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="separator text-danger">Danger Zone</div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <section class="space-y-6">
                                <header>
                                    <h2 class="text-lg font-medium text-dark">
                                        Delete User Account
                                    </h2>
                            
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting account, please download any data or information that you wish to retain.
                                    </p>
                                </header>
                            
                                <button class="btn btn-danger col-lg-12" id="btn-modal-delete" data-toggle="modal" data-target="#modal-delete">Delete Account</button>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <section class="space-y-6">
                                <header>
                                    <h2 class="text-lg font-medium text-dark">
                                        Grant Admin Role
                                    </h2>
                            
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Assign admin role to user
                                    </p>
                                </header>
                                <form action="{{ route('admin.daftar-pengguna.grant') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id_user" value="{{ $data->id }}">
                                    <button class="btn btn-danger col-lg-12" type="submit">Grant Admin Role</button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- modal verifikasi --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-delete">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.daftar-pengguna.destroy', ['user' => $data->id]) }}">
                        @csrf
                        @method('delete')
                        <h2 class="text-lg font-medium text-dark">
                            Are you sure you want to delete your account?
                        </h2>
            
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Once account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you are admin and take the responsibilites to permanently delete user account.
                        </p>
                        <div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="password">
                            </div>
                            @error('password')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row modal-footer br mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" id="submit-confirm">Delete User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('sweetalert::alert')

    <script>
        $("#datatable").dataTable({
            "columnDefs": [
                { "sortable": true, "targets": [0] }
            ]
        });
    </script>
@endpush