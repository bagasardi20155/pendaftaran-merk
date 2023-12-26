@extends('layouts.master')

@section('title', 'Kelola Pengumuman')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Pengumuman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Kelola Pengumuman</div>
            </div>
        </div>

        <a href="{{ route('admin.announcement.generate') }}" class="btn btn-primary mb-3"><i class="fas fa-sync-alt"></i> Generate Pengumuman dari Permohonan Merk</a>
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
                            <th>Pengumuman</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($data) > 0 || $data != null)
                            @foreach ($data as $announcement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $announcement->announcement }}</td>
                                    <td>
                                        @if ( $announcement->type == "generated" )
                                            <span class="badge badge-pill badge-success">
                                                ditampilkan
                                            </span>
                                        @elseif ( $announcement->type == "expired" )
                                            <span class="badge badge-pill badge-dark">
                                                disembunyikan
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-dark" title="User Details"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach    
                        @else    
                            <td colspan="4" class="text-center">Tidak ada pengumuman yang ditemukan</td>
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
            ],
        });
    </script>
@endpush