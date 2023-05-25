@extends('layouts.main')

@section('title','SIDAKEP - Kegiatan')

@section('css')
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />    
@endsection

@section('page-heading','Kegiatan')



@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col" style="margin-top:-6px; margin-bottom:-6px">
                <a href="/kegiatan/create" class="btn  btn-sm btn-secondary float-right">Tambah</a>
            </div>
        </div>
       
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
           
                @if (session('sukses'))
                    
                <div class="alert alert-success alert-dismissible col-md-5 fade show" role="alert">
                    {{ session('sukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
           

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                <thead>
                    <tr>
                      
                        <th>Nama Pegawai</th>
                        <th>Judul kegiatan</th>
                        <th>Waktu Kegiatan</th>
                        <th>Keterangan</th>
                       
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        
                        <th>Nama Pegawai</th>
                        <th>Judul kegiatan</th>
                        <th>Waktu Kegiatan</th>
                        <th>Keterangan</th>
                      
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($kegiatanS as $kegiatan)
                        <tr>

                            
                            <td>{{ $kegiatan->pegawai->nama }}</td>
                            <td>{{ $kegiatan->judul }}</td>
                            <td>{{ $kegiatan->waktu }}</td>
                            <td>
                                {{ $kegiatan->keterangan }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#fotoKegiatan{{ $kegiatan->id }}">Foto</button>
                                @if ($kegiatan->pegawai->kd_pegawai === Auth::user()->pegawai->kd_pegawai)
                                <a href="/kegiatan/{{ $kegiatan->id }}/edit" class="btn btn-info btn-sm mb-1">Edit</a>
                                <form action="/kegiatan/{{ $kegiatan->id }}" class="d-inline-flex" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                                @else
                                    
                                @endif
                               
                            </td>
                        </tr>
                        <!-- Modal gambar-->
                        <div class="modal fade" id="fotoKegiatan{{ $kegiatan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                             
                              <div class="modal-body">
                                <img src="/storage/{{ $kegiatan->gambar }}" class="img-fluid" alt="Foto {{ $kegiatan->judul }}">
                              </div>
                              
                            </div>
                          </div>
                        </div>

                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>



@endsection

@section('javascript')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>

    <script>
       
            $('#dataTable').DataTable( {
               
                "ordering": false
                
            


                } );
        
    </script>
@endsection