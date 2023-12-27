@extends('layouts.master')

@section('title', 'Detail Ajuan Merk')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .timeline-steps {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .timeline-steps .timeline-step {
            align-items: center;
            display: flex;
            flex-direction: column;
            position: relative;
            margin: 1rem;
        }

        @media (min-width: 768px) {
            .timeline-steps .timeline-step:not(:last-child):after {
                content: "";
                display: block;
                border-top: 0.25rem dotted #3b82f6;
                width: 3.46rem;
                position: absolute;
                left: 7.5rem;
                top: 0.3125rem;
            }
            .timeline-steps .timeline-step:not(:first-child):before {
                content: "";
                display: block;
                border-top: 0.25rem dotted #3b82f6;
                width: 3.8125rem;
                position: absolute;
                right: 7.5rem;
                top: 0.3125rem;
            }
        }

        .timeline-steps .timeline-content {
            width: 10rem;
            text-align: center;
        }

        .timeline-steps .timeline-content .inner-circle {
            border-radius: 1.5rem;
            height: 1rem;
            width: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #3b82f6;
        }

        .timeline-steps .timeline-content .inner-circle:before {
            content: "";
            background-color: #3b82f6;
            display: inline-block;
            height: 3rem;
            width: 3rem;
            min-width: 3rem;
            border-radius: 6.25rem;
            opacity: 0.5;
        }
    </style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Ajuan Merk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('applicant.ajuan-merk.index') }}">Daftar Ajuan Merk</a></div>
                <div class="breadcrumb-item">Detail Ajuan Merk</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" title="">
                                                <div class="text-success"><i class="fas fa-check-circle"></i></div>
                                                <p class="h6 mt-3 mb-1">Pengajuan Merk</p>
                                            </div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" title="">
                                                    @if ($status_history[0] == 'waiting')
                                                        <div class="text-primary"><i class="fas fa-adjust"></i></div>
                                                    @elseif (in_array("revision", $status_history) || in_array("rejected", $status_history) || in_array("accepted", $status_history))
                                                        <div class="text-success"><i class="fas fa-check-circle"></i></div>
                                                    @else
                                                    <i class="fas fa-ban"></i>
                                                    @endif
            
                                                    <p class="h6 mt-3 mb-1">Proses Verifikasi</p>
                                                </a>
            
                                            </div>
                                        </div>
            
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" title="">
            
                                                @if ($status_history[0] == 'revision' || $status_history[0] == 'revised')
                                                    <div class="text-primary"><i class="fas fa-adjust"></i></div>
                                                @elseif (in_array("rejected", $status_history) || in_array("accepted", $status_history))
                                                    <div class="text-success"><i class="fas fa-check-circle"></i></div>
                                                @else
                                                    <i class="fas fa-ban"></i>
                                                @endif
            
                                                <p class="h6 mt-3 mb-1">Proses Revisi</p>
                                            </div>
                                        </div>
                                        <div class="timeline-step mb-0">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" title="">
            
                                                @if ($status_history[0] == 'accepted')
                                                    <div class="text-success"><i class="fas fa-check-circle"></i></div>
                                                @elseif ($status_history[0] == 'rejected')
                                                    <div class="text-danger"><i class="fas fa-times-circle"></i></div>
                                                @else
                                                <i class="fas fa-ban"></i>
                                                @endif
            
                                                @if ($status_history[0] == 'accepted')
                                                    <p class="h6 mb-0 mb-lg-0 mt-3">
                                                        Ajuan Diterima
                                                    </p>
                                                @elseif ($status_history[0] == 'rejected')
                                                    <p class="h6 mb-0 mb-lg-0 mt-3">
                                                        Ajuan Ditolak
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('applicant.pengajuan-baru.update', ['pengajuan_baru' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                <div class="row">
                    <div class="col-12 col-md-6">
                        @if ($status[0]['message'] != null)
                            <div class="row">
                                <div class="card col-lg-12" style="background-color: lightcoral;">
                                    <div class="card-body">
                                        <h5 style="color: black">Pesan Verifikasi Admin</h5>
                                        <textarea name="address" id="address" cols="30" rows="3" style="font-size: larger" disabled class="form-control">{{ $status[0]['message'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="card col-lg-12">
                                <div class="card-body">
                                    <h5>Logo Merk</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="{{ asset($data->logo) }}" class="btn btn-primary col-lg-12" style="height: 42px;">File Logo</a>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="logo" id="logo" value="{{ $data->logo }}" accept=".jpg, .png" {{ $status_history[0] == "revision" ? '' : 'disabled'}}>
                                            <small class="form-text text-muted">File: .jpg / .png | Maks. 1 MB</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5>Tanda Tangan Pemohon</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="{{ asset($data->applicant_signature) }}" class="btn btn-info col-lg-12"  style="height: 42px;">File TTD Pemohon</a>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="applicant_signature" id="applicant_signature" value="{{ $data->applicant_signature }}" accept=".jpg, .png" {{ $status_history[0] == "revision" ? '' : 'disabled'}}>
                                            <small class="form-text text-muted">File: .jpg / .png | Maks. 1 MB</small>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->suket_umk != null)
                                    <div class="card-body">
                                        <h5>Surat Keterangan UMK</h5>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <a href="{{ asset($data->suket_umk) }}" class="btn btn-info col-lg-12"  style="height: 42px;">File Suket UMK</a>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="file" class="form-control" name="suket_umk" id="suket_umk" value="{{ $data->suket_umk }}" accept=".pdf, .png" {{ $status_history[0] == "revision" ? '' : 'disabled'}}>
                                                <small class="form-text text-muted">File: .jpg / .pdf | Maks. 2 MB</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Merk</h5>
                                <input name="name" type="text" {{ $status_history[0] == "revision" ? '' : 'disabled'}} value="{{ $data->name }}" class="form-control" disabled>
                            </div>
                            <div class="card-body">
                                <h5>Pemegang Hak Merk</h5>
                                <input name="owner" type="text" {{ $status_history[0] == "revision" ? '' : 'disabled'}} value="{{ $data->owner }}" class="form-control">
                            </div>
                            <div class="card-body">
                                <h5>Kelas Merk</h5>
                                <input type="text" {{ $status_history[0] == "revision" ? '' : 'disabled'}} value="{{ $data->kelas }}" class="form-control">
                            </div>
                            <div class="card-body">
                                <h5>Alamat Usaha</h5>
                                <textarea name="address" id="adress" cols="30" rows="6" {{ $status_history[0] == "revision" ? '' : 'disabled'}} class="form-control" style="height: 100%">{{ $data->address }}</textarea>
                            </div>
                            @if ($status_history[0] == "revision")
                                <div class="card-body">
                                    <button class="btn btn-primary float-right" type="submit">Ajukan Revisi</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
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

        // submit confirmation alert
        $('#submit-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: `Apakah Anda Yakin?`,
                text: "Anda tidak bisa merubah status ajuan kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Submit",
                cancelButtonText: "Cancel",
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    </script>
@endpush