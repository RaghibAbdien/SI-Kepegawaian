@extends('layout.main')

@section('title', 'Absensi')

@section('content')
    @push('head')
        <!-- Datatable -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    @endpush

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Absensi </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
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
                <span>Data Absensi</span>
            @if (Auth::guard('pegawai')->check())
                @if(Auth::guard('pegawai')->user()->status == true)
                <button  class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#addPegawai"><i data-feather="edit"></i> Tambah Absensi</button>
                @endif
            @endif
                
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Waktu Kehadiran</th>
                            <th>Waktu Pulang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::guard('web')->check())
                            @if(Auth::guard('web')->user()->status == true)
                             @foreach ($allAbsensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai->nama }}</td>
                                    <td>{{ $item->waktu_kehadiran }}</td>
                                    <td>{{ $item->waktu_pulang }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button id="hapus-absen" data-id="{{ $item->id }}" class="btn btn-danger">Hapus</button>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailAbsensi{{$item->id}}"><i class="bi bi-eye-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        @elseif (Auth::guard('pegawai')->check())
                            @if (Auth::guard('pegawai')->user()->status == true)
                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $absensi->pegawai->nama }}</td>
                                        <td>{{ $absensi->waktu_kehadiran }}</td>
                                        <td>{{ $absensi->waktu_pulang }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button id="hapus-absen" data-id="{{ $absensi->id }}" class="btn btn-danger">Hapus</button>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailAbsensi{{$absensi->id}}"><i class="bi bi-eye-fill"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif    
                        @endif
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
                    <form id="absensiForm" action="{{ route('tambah-absensi') }}" method="post">
                        @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Tambah Absensi</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nama_pegawai">Nama</label>
                                        <div class="position-relative">
                                            <select class="form-select" id="nama_pegawai" name="id_pegawai">
                                                <option selected value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nama">Waktu Kehadiran</label>
                                        <div class="position-relative">
                                            <input type="datetime-local" class="form-control" id="waktu" name="waktu_kehadiran" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="nama">Waktu Pulang</label>
                                        <div class="position-relative">
                                            <input type="datetime-local" class="form-control" id="waktu" name="waktu_pulang" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama">Keterangan</label>
                                        <div class="position-relative">
                                            <select class="form-control" name="keterangan" id="">
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Cuti">Cuti</option>
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

    <!-- Modal Detail Pegawai -->
    @foreach ($absensis as $absensi)
    <div class="modal fade text-left" id="detailAbsensi{{ $absensi->id }}" tabindex="-1" role="dialog" aria-labelledby="formPegawai" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Detail Absensi</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="container detail-container">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Waktu Kehadiran</strong>
                                        <span>{{ $absensi->waktu_kehadiran }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Waktu Pulang</strong>
                                        <span>{{ $absensi->waktu_pulang }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Keterangan</strong>
                                        <span>{{ $absensi->keterangan }}</span>
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
                $(document).on('click', '#hapus-absen', function() {
                    var id = $(this).data('id');
                    var url = '{{ route("hapus-absen", ":id") }}';
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
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1750
                                    }).then(function() {
                                        // Setelah Swal selesai ditampilkan, lakukan redirect
                                        window.location.href = '{{ route('absensi') }}';
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Gagal menghapus absensi'
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

        @if(session('error'))
        <script>
            // Tampilkan SweetAlert2 dengan pesan error
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        </script>
        @endif

        @if (session('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1750
            });
        </script>
        @endif
    @endpush
@endsection