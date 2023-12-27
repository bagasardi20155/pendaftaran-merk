@extends('layouts.master')

@section('title', 'Home')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
@endpush

@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12">
          <div class="login-brand">
            <img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="Logo KI UNS" style="width: 100px; margin-bottom: 30px"><br>
            <h3 class="text-dark">Sistem Pendaftaran Merk</h3><br>
            <h5 style="margin-top: -30px; color: black">Universitas Sebelas Maret Surakarta</h5>
          </div>

          <div class="card card-primary">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-header"><h4 class="text-dark">Cari Merk Yang Terdaftar di Pangkalan Data Kekayaan Intelektual</h4></div>
                </div>
                @if (auth()->check())
                  @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('dashboard') }}" class="btn btn-info" style="text-align: center; margin-top: 20px">Dashboard</a>
                  @else
                    <a href="{{ route('applicant.ajuan-merk.index') }}" class="btn btn-info" style="text-align: center; margin-top: 20px">Ajuan Merk</a>
                  @endif
                    <div class="col-lg-2">
                    </div>
                @else
                    <div class="col-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-info" style="text-align: center; margin-top: 20px">Login</a>
                    </div>
                @endif
            </div>

            <div class="card-body">
              <form action="{{ route('get_data') }}" method="POST">
                @method('post')
                @csrf
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Merek
                      </div>
                    </div>
                    <input id="name" type="name" class="form-control" name="name" autofocus>
                  </div>
                </div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-lg btn-round btn-primary">
                    Search
                  </button>
                </div>
              </form>
            </div>
          </div>

          {{-- search result --}}
          @if ($input != null)  
            <div class="card card-success">
                <div class="card-header"><h4 class="text-dark">Search Result of '{{ $input }}'</h4></div>

                <div class="card-body">
                    <div class="card px-3 py-2 border shadow-sm border-1" style="border-radius: 5px">
                        <div class="card-body p-0">
                            <div class="table-responsive" style="max-height: 327px">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Merk</th>
                                    <th>Logo</th>
                                    <th>Tgl. Pengajuan</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                </tr>
                                @if ($data == null || count($data) == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @else
                                {{-- {{ dd($data) }} --}}
                                {{-- {{ dd($data) }} --}}
                                    @foreach ($data as $pdki)
                                      @if (count($pdki) == 6)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pdki['name'] }}</td>
                                            <td><img src="{{ $pdki['logo'] }}" alt="Logo Brand" style="width: 50px"></td>
                                            <td>{{ \Carbon\Carbon::parse($pdki['tgl_pengajuan'])->format('Y-m-d') }}</td>
                                            <td>{{ $pdki['kelas'] }}</td>
                                            <td><span class="badge badge-pill badge-warning">{{ \App\Models\Applicant\BrandStatus::where('id_brand', $pdki['id'])->latest()->first()->status }}</span></td>
                                        </tr>
                                      @else
                                        <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $pdki['name'] }}</td>
                                          <td><img src="{{ $pdki['logo'] }}" alt="Logo Brand" style="width: 50px"></td>
                                          <td>{{ \Carbon\Carbon::parse($pdki['tgl_pengajuan'])->format('Y-m-d') }}</td>
                                          <td>{{ $pdki['kelas'] }}</td>
                                          <td><span class="badge badge-pill badge-warning">{{ $pdki['status'] }}</span></td>
                                        </tr>
                                      @endif
                                    @endforeach
                                @endif
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endif

          <div class="simple-footer">
            Copyright &copy; HKI UNS 2023
          </div>
        </div>
      </div>
    </div>
  </section>
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