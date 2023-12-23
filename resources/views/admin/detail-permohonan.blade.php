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
                <div class="breadcrumb-item active"><a href="{{ route('admin.daftar-permohonan.index') }}">Daftar Ajuan Merk</a></div>
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
                                        {{-- {{ dd($status_history) }} --}}
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

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <h5>Nama Merk</h5>
                                    <input type="text" disabled value="{{ $data->name }}" class="form-control">
                                </div>
                                <div class="card-body">
                                    <h5>Pemegang Hak Merk</h5>
                                    <input type="text" disabled value="{{ $data->owner }}" class="form-control">
                                </div>
                                <div class="card-body">
                                    <h5>Alamat Usaha</h5>
                                    <textarea name="address" id="adress" cols="30" rows="6" disabled class="form-control" style="height: 100%">{{ $data->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <h5>Pemohon</h5>
                                    <input type="text" disabled value="{{ $data->user->name }}" class="form-control">
                                </div>
                                <div class="card-body">
                                    <h5>Logo Merk</h5>
                                    <a href="{{ asset($data->logo) }}" class="btn btn-primary col-lg-12">File Logo</a>
                                </div>
                                <div class="card-body">
                                    <h5>Tanda Tangan Pemohon</h5>
                                    <a href="{{ asset($data->applicant_signature) }}" class="btn btn-info col-lg-12">File Tanda Tangan Pemohon</a>
                                </div>
                                @if ($data->suket_umk != null)
                                    <div class="card-body">
                                        <h5>Surat Keterangan UMK</h5>
                                        <a href="{{ asset($data->suket_umk) }}" class="btn btn-info col-lg-12">File Suket UMK</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Similarity with PDKI Data</h5>
                            <div class="card px-3 py-2 border shadow-sm border-1" style="border-radius: 5px">
                                <div class="card-body p-0">
                                    <div class="table-responsive" style="max-height: 327px">
                                      <table class="table table-striped table-md">
                                        <tr>
                                          <th>#</th>
                                          <th>Merk</th>
                                          <th>Akhir Perlindungan</th>
                                          <th>Similarity Rate</th>
                                        </tr>
                                        @if ($data_pdki == null)
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data yang ditemukan</td>
                                            </tr>
                                        @else
                                            @foreach ($data_pdki as $pdki)
                                                {{-- {{ dd($pdki) }} --}}
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pdki['name'] }}</td>
                                                    <td>{{ $pdki['akhir_perlindungan'] }}</td>
                                                    <td><div class="badge badge-danger">{{ round($pdki['similarity_rate']) }}%</div></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                      </table>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($status_history[0] == "accepted" || $status_history[0] == "rejected")
            
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center" style="color: black">Penilaian Hasil Verifikasi</h5>
                                        <button class="btn btn-danger col-lg-12">Verifikasi Ajuan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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