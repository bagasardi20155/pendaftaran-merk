@extends('layouts.master')

@section('title', 'Daftar Pengguna')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Pengguna</div>
            </div>
        </div>

        <a href="#" class="btn btn-info mb-3" id="btn-modal-admin" data-toggle="modal" data-target="#modal-admin"><i class="fas fa-plus"></i> Buat akun admin baru</a>
        <div class="section-body">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($data) > 0 || $data != null)
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{-- {{ dd($user->hasRole('applicant')) }} --}}
                                        @if ($user->hasRole('applicant') && $user->hasRole('admin'))
                                            <span class="badge badge-pill badge-warning">
                                                Pemohon
                                            </span>
                                            <span class="badge badge-pill badge-danger">
                                                Admin
                                            </span>
                                        @elseif ( $user->hasRole('admin'))
                                            <span class="badge badge-pill badge-danger">
                                                Admin
                                            </span>
                                        @elseif ( $user->hasRole('applicant'))
                                            <span class="badge badge-pill badge-warning">
                                                Pemohon
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.daftar-pengguna.detail', ['user' => $user->id]) }}" class="btn btn-dark" title="User Details"><i class="far fa-eye"></i></a>
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
                </div>
            </div>
            </div>
        </div>
    </section>
</div>

{{-- modal make new admin --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-admin">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.new-admin.store') }}">
                    @csrf
                    @method('post')
                    <h4 class="text-lg font-medium text-dark">
                        Buat Akun Admin Baru
                    </h4>
                    <div>
                        <div class="form-group">
                            <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" tabindex="2" required autocomplete="name">
                        </div>
                        @error('name')
                            <div class="text-danger mb-4" >
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="email" class="control-label">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="2" required autocomplete="email">
                        </div>
                        @error('email')
                            <div class="text-danger mb-4" >
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
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
                        <button type="submit" class="btn btn-primary" id="submit-confirm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('sweetalert::alert')

    <script>
        $("#datatable").dataTable({
            "columnDefs": [
                { "sortable": true, "targets": [0] }
            ],
            'dom': "Bfrtip",
            'buttons': [
                'excel',
            ]
        });
    </script>
@endpush