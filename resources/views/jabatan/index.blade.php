@extends('layouts.main')

@section('title','SIDAKEP - Data Jabatan')

@section('css')
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />    
@endsection

@section('page-heading','Data Jabatan')



@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col" style="margin-top:-6px; margin-bottom:-6px">
                <button id="btnTambah" type="button" class="btn  btn-sm btn-secondary float-right">Tambah</button>
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
                
               @if ($errors->any())
               <div class="alert alert-danger alert-dismissible col-md-5 fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               @endif
                
              
                
            <form id="formTambah" action="/jabatan" method="POST" class="col-md-9 d-none">
                <h5 class="text-center pr-5"><b>Tambah Data Jabatan</b></h5>
                @csrf
                <div class="form-row">
                  <div class="col-5">
                    <input type="text" id="kd_jabatan" name="kd_jabatan" class="form-control @error('kd_jabatan') is-invalid @enderror" placeholder="Kode jabatan" autocomplete="off">
                    <div id="validasiKdJabatan" class="invalid-feedback">
                        @error('kd_jabatan')
                        {{ $message }}
                        @enderror
                    </div>
                  </div>
                  
                  
                  <div class="col-5">
                    <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Nama jabatan" autocomplete="off">
                    @error('nama_jabatan')
                    <div id="validasiNamaJabatan" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                  </div>
                </div>
                <hr>
            </form>
           

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                <thead>
                    <tr>
                        <th>Kode Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($jabatanS as $jabatan)
                        <tr>
                            <td>{{ $jabatan->kd_jabatan }}</td>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                            <td>{{ $jabatan->pegawaiS->count() }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal{{ $jabatan->kd_jabatan }}">Edit</button>
                                <form action="/jabatan/{{ $jabatan->kd_jabatan }}" class="d-inline-flex" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        {{-- edit modal --}}
                        <div class="modal fade" id="editModal{{ $jabatan->kd_jabatan }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editModalLabel">Ubah data</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/jabatan/{{ $jabatan->kd_jabatan }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="kd_jabatan">Kode jabatan</label>
                                            <input type="text" id="kd_jabatan" name="kd_jabatan" class="form-control" placeholder="Kode jabatan" value="{{ $jabatan->kd_jabatan}}" required autocomplete="off">
                                            
                                          </div>
                                          
                                          
                                          <div class="col form-group">
                                            <label for="nama_jabatan">Nama jabatan</label>
                                            <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" placeholder="Nama jabatan" value="{{ $jabatan->nama_jabatan}}" required autocomplete="off">
                                           
                                          </div>
                                        </div>
                                       
                                    
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                    </form>
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
        $('#btnTambah').click(function (e) { 
            e.preventDefault();
            $('#formTambah').removeClass('d-none');
            $('#btnTambah').addClass('d-none');
        });

       
            $('#btnSimpan').click(function (e) {
                e.preventDefault();
                if ($('#kd_jabatan').val()=='' && $('#nama_jabatan').val()=='') {
                    $('#formTambah').addClass('d-none');
                    $('#btnTambah').removeClass('d-none');
                } else {
                    $('#formTambah').submit();
                };


            });
      
       // validasi kode jabatan
       $('#kd_jabatan').keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) ) {
                $('#kd_jabatan').addClass('is-invalid');
                $('#validasiKdJabatan').text('Kode jabatan tidak boleh mengandung huruf dan spasi!');
                return false;
    
            } else if ($('#kd_jabatan').val().length >=5 ) {
                $('#kd_jabatan').removeClass('is-invalid');
                return false;
            } else if ($('#kd_jabatan').val().length != 4 ) {
                $('#kd_jabatan').addClass('is-invalid');
                $('#validasiKdJabatan').text('Kode jabatan harus 5 karakter!');
                
            } else {
                $('#kd_jabatan').removeClass('is-invalid');
                
            }
        });
    </script>
@endsection