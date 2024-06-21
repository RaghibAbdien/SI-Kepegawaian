@extends('layout.main')

@section('title', 'Data Pegawai')

@section('content')
    @push('head')
        <!-- Datatable -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

        <style>
            .detail-container {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .list-group-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .list-group-item span {
                font-weight: bold;
            }
        </style>
    @endpush

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pegawai </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Data Pegawai</span>
                <button  class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#addPegawai"><i data-feather="edit"></i> Tambah Pegawai</button>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pegawai->nip }}</td>
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->alamat }}</td>
                                <td>
                                    <span class="
                                    @if ($pegawai->status == 1)
                                        badge bg-success
                                    @else
                                        badge bg-danger    
                                    @endif
                                    ">
                                    @if ($pegawai->status == 1)
                                        Aktif
                                    @else
                                        Tidak Aktif    
                                    @endif
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailPegawai{{ $pegawai->id }}"><i class="bi bi-eye-fill"></i></button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPegawai{{ $pegawai->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <button id="hapus-pegawai" data-id="{{ $pegawai->id }}" class="btn btn-danger"><i class="bi bi-x-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade text-left" id="addPegawai" tabindex="-1" role="dialog" aria-labelledby="formPegawai" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                    <form id="pegawaiForm" action="{{ route('tambah-pegawai') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Tambah Pegawai</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nip">NIP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" id="nip" name="nip" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nama">Nama</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email">Email</label>
                                        <div class="position-relative">
                                            <input type="email" class="form-control" id="email" name="email" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="password">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="d-flex justify-content-around mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" required>
                                                <label class="form-check-label" for="laki_laki">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                                                <label class="form-check-label" for="perempuan">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <div class="position-relative">
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nohp">No. HP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" id="nohp" name="nohp" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="position-relative">
                                            <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .png, .jpeg" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="agama">
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Protestan">Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="pendidikan">
                                                <option value="SMA/SMK/Sederajat">SMA/SMK/Sederajat</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"><i class="bx bx-x"></i><span>Close</span></button>
                        <button type="submit" class="btn btn-primary ml-1"><i class="bx bx-check"></i><span>Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit Pegawai -->
    @foreach ($pegawais as $pegawai)
    <div class="modal fade text-left" id="editPegawai{{ $pegawai->id }}" tabindex="-1" role="dialog" aria-labelledby="formPegawai" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                    <form action="{{ route('edit-pegawai', $pegawai->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Edit Pegawai</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nip{{$pegawai->id}}">NIP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" id="nip{{$pegawai->id}}" name="nip" value="{{ $pegawai->nip }}" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nama{{$pegawai->id}}">Nama</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="nama{{$pegawai->id}}" name="nama" value="{{ $pegawai->nama }}" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email{{$pegawai->id}}">Email</label>
                                        <div class="position-relative">
                                            <input type="email" class="form-control" id="email{{$pegawai->id}}" name="email" value="{{ $pegawai->email }}" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="password{{$pegawai->id}}">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="password{{$pegawai->id}}" name="password">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="d-flex justify-content-around mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki{{$pegawai->id}}" value="Laki-Laki" {{ $pegawai->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="laki_laki">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan{{$pegawai->id}}" value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="perempuan">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="alamat{{$pegawai->id}}">Alamat</label>
                                        <div class="position-relative">
                                            <textarea class="form-control" id="alamat{{$pegawai->id}}" name="alamat" rows="3" required>{{ $pegawai->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nohp{{$pegawai->id}}">No. HP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" id="nohp{{$pegawai->id}}" name="nohp" value="{{ $pegawai->nohp }}" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="foto{{$pegawai->id}}">Foto</label>
                                        <div class="position-relative">
                                            <input type="file" class="form-control" id="foto{{$pegawai->id}}" name="foto" accept=".jpg, .png, .jpeg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="status" id="status{{$pegawai->id}}">
                                                <option value="1" {{ $pegawai->status == 1 ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ $pegawai->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="agama">
                                                <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Protestan" {{ $pegawai->agama == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                                <option value="Katolik" {{ $pegawai->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ $pegawai->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="pendidikan">
                                                <option value="SMA/SMK/Sederajat" {{ $pegawai->pendidikan == 'SMA/SMK/Sederajat' ? 'selected' : '' }}>SMA/SMK/Sederajat</option>
                                                <option value="S1" {{ $pegawai->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2" {{ $pegawai->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3" {{ $pegawai->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                                                <option value="D1" {{ $pegawai->pendidikan == 'D1' ? 'selected' : '' }}>D1</option>
                                                <option value="D2" {{ $pegawai->pendidikan == 'D2' ? 'selected' : '' }}>D2</option>
                                                <option value="D3" {{ $pegawai->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                                                <option value="D4" {{ $pegawai->pendidikan == 'D4' ? 'selected' : '' }}>D4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"><i class="bx bx-x"></i><span>Close</span></button>
                        <button type="submit" class="btn btn-primary ml-1"><i class="bx bx-check"></i><span>Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Modal Detail Pegawai -->
    @foreach ($pegawais as $pegawai)
    <div class="modal fade text-left" id="detailPegawai{{ $pegawai->id }}" tabindex="-1" role="dialog" aria-labelledby="formPegawai" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Detail Pegawai</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-content">
                                <img src="{{ Storage::url($pegawai->foto_pegawai) }}" class="card-img-top img-fluid"
                                    alt="singleminded">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pegawai->nama }}</h5>
                                </div>
                            </div>
                            <div class="container detail-container">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Email</strong>
                                        <span>{{ $pegawai->email }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Jenis Kelamin</strong>
                                        <span>{{ $pegawai->jenis_kelamin }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>No. HP</strong>
                                        <span>{{ $pegawai->nohp }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Agama</strong>
                                        <span>{{ $pegawai->agama }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Pendidikan</strong>
                                        <span>{{ $pegawai->pendidikan }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"><i class="bx bx-x"></i><span>Close</span></button>
                    </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('js')
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('form:not(#formToExclude)').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
        
                // Menonaktifkan tombol submit
                form.find('button[type="submit"]').prop('disabled', true).text('Processing...');
        
                // Membuat objek FormData
                var formData = new FormData(form[0]);
        
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    contentType: false, // Tidak mengatur tipe konten
                    processData: false, // Tidak memproses data
                    success: function(response) {
                        // Jika validasi berhasil, redirect atau lakukan tindakan lain
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil",
                            showConfirmButton: false,
                            timer: 1750
                        }).then(function() {
                            // Setelah Swal selesai ditampilkan, lakukan redirect
                            window.location.href = '{{ route('pegawai') }}';
                        });
                    },
                    error: function(xhr) {
                        // Jika validasi gagal, tampilkan pesan kesalahan menggunakan SweetAlert
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
        
                        $.each(errors, function(index, value) {
                            errorMessage += value + '<br>';
                        });
        
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: errorMessage
                        });
        
                        // Mengaktifkan kembali tombol submit 
                        form.find('button[type="submit"]').prop('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#hapus-pegawai', function() {
                var id = $(this).data('id');
                var url = '{{ route("hapus-pegawai", ":id") }}';
                url = url.replace(':id', id);
                var $button = $(this); // Cache the button jQuery object

                // Tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the button
                        $button.attr('disabled', 'disabled');

                        // Kirim permintaan hapus menggunakan AJAX
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                console.log("Success: ", response); // Debug log
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Data berhasil dihapus",
                                    showConfirmButton: false,
                                    timer: 1750
                                }).then(function() {
                                    // Setelah Swal selesai ditampilkan, lakukan redirect
                                    window.location.href = '{{ route('pegawai') }}';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Gagal menghapus data'
                                });

                                $button.removeAttr('disabled');
                            },
                            complete: function() {
                                // Enable the button after the request completes
                                $button.removeAttr('disabled');
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ketika modal ditutup, reset form
            $('#addPegawai').on('hidden.bs.modal', function () {
                $('#pegawaiForm')[0].reset();
            });
        });
    </script>
    @endpush
@endsection