@extends('layouts.main')

@section('title','SIDAKEP - Data Pegawai')

@section('css')
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" /> 
  <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-heading','Edit Data Pegawai')



@section('konten')
<div class="card shadow mb-4">
    <div class="card-body">
      @if (session('sukses'))
                    
        <div class="alert alert-success alert-dismissible col-md-5 fade show" role="alert">
            {{ session('sukses') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form action="{{ Request::is('pegawai/data-pegawai*') ? '/pegawai/data-pegawai/'.$pegawai->kd_pegawai : '/profil/'.$pegawai->kd_pegawai}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div class="form-row mb-4">
            <div class="col-md-2">
              <div id="gambarPreview" class="border-image d-none">
                <img class="img-preview">
              </div>
              <div id="gambarPertama" class="border-image">
                <img src="/storage/{{$pegawai->pas_foto}}" class="img-preview" alt="foto {{ $pegawai->nama }}">
              </div>
            </div>
            <div class="custom-file col-md-4 mt-5">
              <input type="file" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="pas_foto" name="pas_foto" onchange="previewImage()">
              <label class="custom-file-label" for="pas_foto" >Pilih foto</label>
              @error('pas_foto')
              <div id="validasiGambar" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama">Nama lengkap</label>
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $pegawai->nama) }}">
              <small id="bantuanNama" class="form-text text-muted">
                Nama lengkap dengan gelar jika ada
               </small>
              @error('nama')
              <div id="validasiNama" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="nik">NIK</label>
              <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik',$pegawai->nik) }}">
              <div id="validasiNik" class="invalid-feedback">
                @error('nik')
                  {{ $message }}
                @enderror
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="tempat_lahir">Tempat lahir</label>
              <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
              @error('tempat_lahir')
              <div id="validasiTempatLahir" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-3">
              <label for="tanggal_lahir">Tanggal lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}">
              @error('tanggal_lahir')
              <div id="validasiTanggalLahir" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-3">
              <label for="jenis_kelamin">Jenis kelamin</label>
              <select id="jenis_kelamin" name="jenis_kelamin" class="custom-select @error('jenis_kelamin') is-invalid @enderror">
                <option value="">--Pilih--</option>
                <option value="1" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == '1' || old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? ' selected' : ' ' }}>Laki-laki</option>
                <option value="2" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == '2' || old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? ' selected' : ' ' }}>Perempuan</option>
              </select>
              @error('jenis_kelamin')
              <div id="validasiJenisKelamin" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-3">
              <label for="agama">Agama</label>
              <select id="agama" name="agama" class="custom-select @error('agama') is-invalid @enderror">
                <option value="">--Pilih--</option>
                <option value="1" {{ old('agama', $pegawai->agama) == '1' || old('agama', $pegawai->agama) == 'Islam' ? ' selected' : ' ' }}>Islam</option>
                <option value="2" {{ old('agama', $pegawai->agama) == '2' || old('agama', $pegawai->agama) == 'Protestan' ? ' selected' : ' ' }}>Protestan</option>
                <option value="3" {{ old('agama', $pegawai->agama) == '3' || old('agama', $pegawai->agama) == 'Katolik' ? ' selected' : ' ' }}>Katolik</option>
                <option value="4" {{ old('agama', $pegawai->agama) == '4' || old('agama', $pegawai->agama) == 'Hindu' ? ' selected' : ' ' }}>Hindu</option>
                <option value="5" {{ old('agama', $pegawai->agama) == '5' || old('agama', $pegawai->agama) == 'Buddha' ? ' selected' : ' ' }}>Buddha</option>
                <option value="6" {{ old('agama', $pegawai->agama) == '6' || old('agama', $pegawai->agama) == 'Khonghucu' ? ' selected' : ' ' }}>Khonghucu</option>
              </select>
              @error('agama')
              <div id="validasiAgama" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-3">
              <label for="no_hp">No hp</label>
              <input type="text" name="no_hp" value="{{ old('no_hp',$pegawai->no_hp) }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp">
              <div id="validasiNoHp" class="invalid-feedback">
                @error('no_hp')
                  {{ $message }}
                  @enderror
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="tanggal_masuk">Tanggal masuk</label>
              <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk) }}" readonly>
              @error('tanggal_masuk')
              <div id="validasiTanggalMasuk" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="jabatan_id">Jabatan</label>
              <select id="jabatan_id" name="jabatan_id" class="custom-select @error('jabatan_id') is-invalid @enderror">
                <option value="">--Pilih--</option>
                @foreach ($jabatanS as $jabatan)
                <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $pegawai->jabatan_id) == $jabatan->id ? ' selected' : ' ' }}>{{ $jabatan->nama_jabatan }}</option>
                @endforeach
              </select>
              @error('jabatan_id')
              <div id="validasiPositionId" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
           
            
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat', $pegawai->alamat) }}">
            @error('alamat')
              <div id="validasiAlamat" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
          <div class="custom-file col-md-7 mb-3">
            <input type="file" class="custom-file-input @error('ktp') is-invalid @enderror" name="ktp" id="ktp" >
            <label class="custom-file-label" for="ktp">Upload berkas ktp</label>
            @error('ktp')
            <div id="validasiKtp" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <small class=" text-muted pb-0 mb-0 d-inline-flex">
            <ul>
              <li>Ktp berupa pdf</li>
              <li>Ktp max 1 mb</li>
              <li>Ktp tidak perlu diupload jika tidak ingin diganti!</li>

            </ul>
           </small>
          <div class="custom-file col-md-7 mb-3">
            <input type="file" class="custom-file-input @error('kk') is-invalid @enderror" name="kk" id="kk" >
            <label class="custom-file-label" for="kk">Upload berkas kartu keluarga</label>
            @error('kk')
            <div id="validasiKk" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <small class=" text-muted pb-0 mb-0 d-inline-flex">
            <ul>
              <li>Kart keluarga berupa pdf</li>
              <li>Kartu keluarga max 1 mb</li>
              <li>Kartu keluarga tidak perlu diupload jika tidak ingin diganti!</li>
            </ul>
           </small>
          
          <div class="custom-file col-md-7 mb-3">
            <input type="file" class="custom-file-input @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" >
            <label class="custom-file-label" for="akta_lahir">Upload berkas akta kelahiran</label>
            @error('akta_lahir')
            <div id="validasiAktaLahir" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <small class=" text-muted pb-0 mb-0 d-inline-flex">
            <ul>
              <li>Akta lahir berupa pdf</li>
              <li>Akta lahir max 1 mb</li>
              <li>Akta lahir tidak perlu diupload jika tidak ingin diganti!</li>
            </ul>
           </small>

          <div class="custom-file col-md-7 mb-3">
            <input type="file" class="custom-file-input @error('cv') is-invalid @enderror" name="cv" id="cv" >
            <label class="custom-file-label" for="cv">Upload berkas CV</label>
            @error('cv')
            <div id="validasiCv" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <small class=" text-muted pb-0 mb-0 d-inline-flex">
            <ul>
              <li>CV berupa pdf</li>
              <li>CV max 1 mb</li>
              <li>CV tidak perlu diupload jika tidak ingin diganti!</li>
            </ul>
           </small>
          <button type="submit" class="btn btn-primary d-flex">Simpan</button>
        </form>
    </div>
</div>
@endsection


@section('javascript')

   <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

    <script>
        // bs-custom-file-input
        $(document).ready(function () {
          bsCustomFileInput.init()
        });

        // menampilkan pas_foto preview
        function previewImage() {
          $('#gambarPreview').removeClass('d-none');
          $('#gambarPertama').remove();
          const image = document.querySelector('#pas_foto');
          const imgPreview = document.querySelector('.img-preview');
          
          
          imgPreview.style.display = 'block';

          const oFReader  = new FileReader();
          oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
              imgPreview.src = oFREvent.target.result;
           }

        };


        // validasi nik
        $('#nik').keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) ) {
                $('#nik').addClass('is-invalid');
                $('#validasiNik').text('NIK tidak boleh mengandung huruf dan spasi!');
                return false;
    
            } else if ($('#nik').val().length > 15) {
                $('#nik').addClass('is-invalid');
                $('#validasiNik').text('NIK hanya boleh 16 karakter!');
                return false;
            } else {
                $('#nik').removeClass('is-invalid');
                
            }
        });	

        // validasi no hp
        $('#no_hp').keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) ) {
                $('#no_hp').addClass('is-invalid');
                $('#validasiNoHp').text('No hp tidak boleh mengandung huruf dan spasi!');
                return false;
    
            } else if ($('#no_hp').val().length > 12) {
                $('#no_hp').addClass('is-invalid');
                $('#validasiNoHp').text('No hp maksimal 13 karakter!');
                return false;
            } else {
                $('#no_hp').removeClass('is-invalid');
                
            }
        });	
    </script>
@endsection
