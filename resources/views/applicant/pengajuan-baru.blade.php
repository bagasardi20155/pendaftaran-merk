@extends('layouts.master')

@section('title', 'Pengajuan Merk Baru')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Form Pengajuan Merk</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-3 col-lg-8 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <b>Perhatian!</b> Isikan dengan benar. Anda hanya bisa merubah data setelah verifikasi administrator.
                        </div>

                        <form action="{{ route('applicant.pengajuan-baru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                            
                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="name" class="control-label">Nama Merk / Usaha</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Merk / Usaha" required value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="address" class="control-label">Alamat Merk / Usaha</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Alamat Merk / Usaha" required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="owner" class="control-label">Nama Pemilik Merk / Usaha</label>
                                <input type="text" class="form-control" name="owner" id="owner" placeholder="Nama Pemilik Merk / Usaha" required value="{{ old('owner') }}">
                            </div>
                            @error('owner')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="control-label" for="logo" style="font-weight: 600; font-size: 12px; color: #34395e">Logo Merk / Usaha</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" name="logo" id="logo" required value="{{ old('logo') }}">
                                <label class="custom-file-label" for="logo">Choose file</label>
                                <small class="form-text text-muted">File: .jpg / .png | Maks. 1 MB</small>
                            </div>
                            @error('logo')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="suket_umk" style="font-weight: 600; font-size: 12px; color: #34395e">Surat Keterangan UMK</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" name="suket_umk" id="suket_umk" value="{{ old('suket_umk') }}">
                                <label class="custom-file-label" for="suket_umk">Choose file</label>
                                <small class="form-text text-muted">File: .jpg / .pdf | Maks. 2 MB</small>
                            </div>
                            @error('suket_umk')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="control-label" for="applicant_signature" style="font-weight: 600; font-size: 12px; color: #34395e">Tanda Tangan Pemohon</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" name="applicant_signature" id="applicant_signature" required value="{{ old('applicant_signature') }}">
                                <label class="custom-file-label" for="applicant_signature">Choose file</label>
                                <small class="form-text text-muted">File: .jpg / .png | Maks. 1 MB</small>
                            </div>
                            @error('applicant_signature')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            
                            <button class="btn btn-primary mr-1 float-right" type="submit">Daftarkan Merk</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection