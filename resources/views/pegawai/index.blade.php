@extends('layouts.main')

@section('title','SIDAKEP - Data Pegawai')

@section('css')
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" /> 
  <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-heading','Data Pegawai')



@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col" style="margin-top:-6px; margin-bottom:-6px">
                <a href="/pegawai/data-pegawai/laporan" class="btn  btn-sm btn-secondary float-right" target="_blank">Buat laporan</a>
            </div>
        </div>
       
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Pegawai</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Pegawai</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($pegawaiS as $pegawai)
                        <tr>
                            <td>{{ $pegawai->kd_pegawai }}</td>
                            <td>
                                <div class="border-image">
                                    <img src="/storage/{{$pegawai->pas_foto }}" class="img-preview" alt="foto {{ $pegawai->nama }}">
                                </div>
                            </td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>{{ $pegawai->jabatan->nama_jabatan }}</td>
                            <td>{{ $pegawai->jenis_kelamin }}</td>
                            <td>
                                <a href="/pegawai/data-pegawai/{{ $pegawai->kd_pegawai }}" class="btn btn-primary btn-sm mt-1">Lihat</a>
                                <a href="/pegawai/data-pegawai/{{ $pegawai->kd_pegawai }}/edit" class="btn btn-info btn-sm mt-1">Edit</a>
                                <form action="/pegawai/data-pegawai/{{ $pegawai->kd_pegawai }}" class="d-inline-flex mt-1" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus? Menghapus data pegawai akan menghapus semua data terkait')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
@endsection