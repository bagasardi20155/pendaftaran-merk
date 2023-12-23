@extends('layouts.master')

@section('title', 'Daftar Ajuan Merk')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Ajuan Merk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Ajuan Merk</div>
            </div>
        </div>

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
                            <th>Brand</th>
                            <th>Address</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($data) > 0 || $data != null)
                            @foreach ($data as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->address }}</td>
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
            ]
        });
    </script>
@endpush