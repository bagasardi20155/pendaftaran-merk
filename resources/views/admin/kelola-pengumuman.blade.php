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
        <a href="#" class="btn btn-info mb-3" id="btn-modal-announcement" data-toggle="modal" data-target="#modal-announcement"><i class="fas fa-plus"></i> Buat Announcement Baru</a>
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
                            <th>Tipe</th>
                            <th>Ditampilkan</th>
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
                                            <span class="badge badge-pill badge-primary">
                                                generated
                                            </span>
                                        @elseif ( $announcement->type == "created" || $announcement->type == "expired_created" )
                                            <span class="badge badge-pill badge-info">
                                                created by admin
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.announcement.update', ['announcement' => $announcement->id]) }}" method="POST">
                                            @method('put')
                                            @csrf

                                            <div class="form-group">
                                                <label class="custom-switch mt-2">
                                                  <input type="checkbox" name="type" onchange="this.form.submit()" class="custom-switch-input" 
                                                    {{ $announcement['type'] == "generated" ? "disabled" : "" }}
                                                    @if ($announcement['type'] == "created")
                                                        checked
                                                    @elseif ($announcement['type'] == "generated")
                                                        checked
                                                    @endif>
                                                  <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        @if ($announcement->type == "created" || $announcement->type == "expired_created")
                                        <form action="{{ route('admin.announcement.destroy', ['announcement' => $announcement->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf

                                            <button type="submit" class="btn btn-danger" title="Hapus Pengumuman"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                        @endif
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

{{-- modal announcement --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-announcement">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.announcement.store') }}">
                    @csrf
                    @method('post')
                    <h4 class="text-lg font-medium text-dark">
                        Tambah Pengumuman Baru
                    </h4>
                    <div>
                        <div class="form-group">
                            <label for="headline" class="control-label">Headline Pengumuman <span class="text-danger">*</span></label>
                            <input id="headline" type="headline" class="form-control" name="headline" tabindex="2" required autocomplete="headline">
                        </div>
                        @error('headline')
                            <div class="text-danger mb-4" >
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="content" class="control-label">Isi Pengumuman <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" cols="30" rows="3" required class="form-control" style="height: 100%"></textarea>
                        </div>
                        @error('content')
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