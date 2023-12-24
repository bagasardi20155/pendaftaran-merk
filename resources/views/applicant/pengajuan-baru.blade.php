@extends('layouts.master')

@section('title', 'Pengajuan Merk Baru')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Pengajuan Merk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Form Pengajuan Merk</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <b>Perhatian!</b> Isikan dengan benar. Anda hanya bisa merubah data setelah verifikasi administrator.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('applicant.pengajuan-baru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                            
                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="name" class="control-label">Nama Merk / Usaha <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Merk / Usaha" required value="{{ old('name') }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <a class="btn btn-primary" id="check-btn" style="color: white">Check Similarity</a>
                                    </div>
                                </div>
                            </div>
                            @error('name')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="address" class="control-label">Alamat Merk / Usaha <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="address" placeholder="Alamat Merk / Usaha" required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="owner" class="control-label">Nama Pemilik Merk / Usaha <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="owner" id="owner" placeholder="Nama Pemilik Merk / Usaha" required value="{{ old('owner') }}">
                            </div>
                            @error('owner')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="control-label" for="logo" style="font-weight: 600; font-size: 12px; color: #34395e">Logo Merk / Usaha <span class="text-danger">*</span></label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" name="logo" id="logo" required value="{{ old('logo') }}" accept=".jpg, .png" onchange="imagePreview('logo', 'imageLogo')">
                                <label class="custom-file-label" for="logo">Choose file</label>
                                <small class="form-text text-muted">File: .jpg / .png | Maks. 1 MB</small>
                            </div>
                            @error('logo')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="suket_umk" style="font-weight: 600; font-size: 12px; color: #34395e">Surat Keterangan UMK (optional)</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input form-control" name="suket_umk" id="suket_umk" value="{{ old('suket_umk') }}" accept=".pdf, .png">
                                <label class="custom-file-label" for="suket_umk">Choose file</label>
                                <small class="form-text text-muted">File: .jpg / .pdf | Maks. 2 MB</small>
                            </div>
                            @error('suket_umk')
                                <div class="text-danger mb-4" >
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="control-label" for="applicant_signature" style="font-weight: 600; font-size: 12px; color: #34395e">Tanda Tangan Pemohon <span class="text-danger">*</span></label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" name="applicant_signature" id="applicant_signature" required value="{{ old('applicant_signature') }}" accept=".jpg, .png" onchange="imagePreview('applicant_signature', 'imageSignature')">
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

                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive" style="max-height: 327px">
                              <table class="table table-striped table-md" id="table-pdki">
                                <thead>
                                    <tr>
                                      <th>Merk</th>
                                      <th>Akhir Perlindungan</th>
                                      <th>Similarity Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="item-pdki"></tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <h5>Logo Merk</h5>
                                    <img class="img-fluid" id="imageLogo" alt="" width="150px">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body py-4">
                                    <h5>Tanda Tangan Pemohon</h5>
                                    <img class="img-fluid" id="imageSignature" alt="" width="150px">
                                </div>
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
    <script>
        function imagePreview(input_id, img_preview_id) {
            const image = document.querySelector('#'+input_id);
            const imgPreview = document.querySelector('#'+img_preview_id);

            imgPreview.style.display = 'block';
            imgPreview.style.maxHeight = '300px';
            imgPreview.classList.add('border');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                document.querySelector('#photoProfileButton').classList.remove('d-none');
            }
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for the submit button
        document.getElementById('check-btn').addEventListener('click', function() {
            // Get the input value
            let inputValue = document.getElementById('name').value;
    
            // Make an AJAX POST request to your Laravel route
            fetch('/applicant/data-pdki', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use Laravel's CSRF protection
                },
                body: JSON.stringify({ inputText: inputValue })
            })
            .then(response => response.json())
            .then(data => {
                // Update the table with the received array data
                let tableBody = document.getElementById('item-pdki');
                tableBody.innerHTML = ''; // Clear existing rows
    
                data.forEach(item => {
                    let row = tableBody.insertRow();
                    // Example: assuming 'item' is an object with properties 'column1' and 'column2'
                    row.innerHTML = `<td>${item.name}</td><td>${item.akhir_perlindungan}</td><td><div class="badge badge-danger">${item.similarity_rate}%</div></td>`;
                    // Add more cells based on your array structure
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    </script>    
@endpush