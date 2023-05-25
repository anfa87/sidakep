<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIDAKEP - Register</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">

</head>

<body style="background-color: rgb(220, 223, 232)">



<div class="container bg-white mt-5" ">
  <h1 class="display-4 p-5 text-center">Registrasi</h1>
  
</div>
<div class="container py-5 bg-white">
  <div class="row justify-content-center">
    <div class="card w-75">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a id="linkAkun" class="nav-link active" href="#">Form akun</a>
          </li>
          <li class="nav-item">
            <a id="linkBiodata" class="nav-link disabled" href="#">Form biodata</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        
        <form action="/register" method="POST" enctype="multipart/form-data">
          @csrf
          {{-- form 1 --}}
          <div id="formAkun">
            <h3 class="text-center">Buat Akun</h3>
            <hr>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" autocomplete="off" id="username">
                @error('username')
                <div id="validasiUsername" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email">
                @error('email')
                    <div id="validasiEmail" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password">
                @error('password')
                <div id="validasiPassword" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" id="password_confirmation">
                @error('password_confirmation')
                <div id="validasiPasswordConfirmation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
          </div>
          
          {{-- form 2 --}}
          <div id="formBiodata" class="d-none">
            <h3 class="text-center">Isi Biodata Diri</h3>
            <hr>
            <div class="form-row mb-4">
              <div class="col-md-2">
                <div class="border-image d-none">
                  <img class="img-preview">
                </div>
                <div class="kotak text-center">
                  
                  Pas foto<br>3x4
                </div>
              </div>
              <div class="custom-file col-md-4 mt-5">
                <input type="file" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="pas_foto" name="pas_foto" value="{{ old('pas_foto') }}" onchange="previewImage()" required>
                <label class="custom-file-label" for="pas_foto" >Pilih foto</label>
                <small id="bantuanPasFoto" class="form-text text-muted">
                 Ukuran pas foto maksimal 1 mb
                </small>
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
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" required>
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
                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik') }}" required>
                <div id="validasiNik" class="invalid-feedback">
                  @error('nik')
                    {{ $message }}
                  @enderror
                </div>
              </div>
              <div class="form-group col-md-3">
                <label for="tempat_lahir">Tempat lahir</label>
                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                <div id="validasiTempatLahir" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label for="tanggal_lahir">Tanggal lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                <div id="validasiTanggalLahir" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label for="jenis_kelamin">Jenis kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="custom-select @error('jenis_kelamin') is-invalid @enderror" required>
                  <option value="">--Pilih--</option>
                  <option value="1" {{ old('jenis_kelamin') == '1' ? ' selected' : ' ' }}>Laki-laki</option>
                  <option value="2" {{ old('jenis_kelamin') == '2' ? ' selected' : ' ' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                <div id="validasiJenisKelamin" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label for="agama">Agama</label>
                <select id="agama" name="agama" class="custom-select @error('agama') is-invalid @enderror" required>
                  <option value="">--Pilih--</option>
                  <option value="1" {{ old('agama') == '1' ? ' selected' : ' ' }}>Islam</option>
                  <option value="2" {{ old('agama') == '2' ? ' selected' : ' ' }}>Protestan</option>
                  <option value="3" {{ old('agama') == '3' ? ' selected' : ' ' }}>Katolik</option>
                  <option value="4" {{ old('agama') == '4' ? ' selected' : ' ' }}>Hindu</option>
                  <option value="5" {{ old('agama') == '5' ? ' selected' : ' ' }}>Buddha</option>
                  <option value="6" {{ old('agama') == '6' ? ' selected' : ' ' }}>Khonghucu</option>
                </select>
                @error('agama')
                <div id="validasiAgama" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label for="no_hp">No hp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" required>
                <div id="validasiNoHp" class="invalid-feedback">
                  @error('no_hp')
                    {{ $message }}
                    @enderror
                </div>
              </div>
              <div class="form-group col-md-3">
                <label for="tanggal_masuk">Tanggal masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                @error('tanggal_masuk')
                <div id="validasiTanggalMasuk" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="jabatan_id">Jabatan</label>
                <select id="jabatan_id" name="jabatan_id" class="custom-select @error('jabatan_id') is-invalid @enderror" required>
                  <option value="">--Pilih--</option>
                  @foreach ($positions as $position)
                  <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? ' selected' : ' ' }}>{{ $position->nama_jabatan }}</option>
                  @endforeach
                 
                </select>
                @error('jabatan_id')
                <div id="validasiPositionId" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
             
              
            </div>
            <div class="form-group mb-3">
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat') }}" required>
              @error('alamat')
                <div id="validasiAlamat" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           
              <div class="custom-file col-md-8 mb-3">
                <input type="file" class="custom-file-input @error('ktp') is-invalid @enderror" name="ktp" id="ktp" required>
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
                </ul>
               </small>
              <div class="custom-file col-md-8 mb-3">
                <input type="file" class="custom-file-input @error('kk') is-invalid @enderror" name="kk" id="kk" required>
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
                </ul>
               </small>
              
              <div class="custom-file col-md-8 mb-3">
                <input type="file" class="custom-file-input @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" required>
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
                </ul>
               </small>

              <div class="custom-file col-md-8 mb-3">
                <input type="file" class="custom-file-input @error('cv') is-invalid @enderror" name="cv" id="cv" required>
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
                </ul>
               </small>
            
          </div>
          
          <button type="button" id="btnSelanjutnya" class="btn btn-secondary float-right">Selanjutnya <i class="far fa-arrow-alt-circle-right"></i></button>
          <button type="submit" disabled id="btnSimpan" class="btn btn-primary d-none float-right mb-2" onclick="return confirm('Apakah data yang anda masukan sudah benar?')"><i class="fas fa-save"></i> Simpan</button>
          <button type="button" id="btnSebelumnya" class="btn btn-secondary d-none"><i class="far fa-arrow-alt-circle-left"></i> Sebelumnya</button>
        </form>
      </div>
    </div>
  </div>
  
</div>
  

   <!-- Bootstrap core JavaScript-->
   <script src="/vendor/jquery/jquery.min.js"></script>
   <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

   <script>
    // perpindahan form 1 dan 2
     $('#btnSelanjutnya').click(function (e) { 
            e.preventDefault();
            $('#btnSelanjutnya').addClass('d-none');
            $('#btnSebelumnya').removeClass('d-none');
            $('#btnSimpan').removeClass('d-none');
            $('#btnSimpan').prop('disabled', false);
            $('#formBiodata').removeClass('d-none');
            $('#formAkun').addClass('d-none');
            $('#linkAkun').removeClass('active').addClass('disabled');
            $('#linkBiodata').removeClass('disabled').addClass('active');
            
           
        });
    
        $('#btnSebelumnya').click(function (e) { 
            e.preventDefault();
            $('#btnSebelumnya').addClass('d-none');
            $('#btnSelanjutnya').removeClass('d-none');
            $('#btnSimpan').addClass('d-none');
            $('#btnSimpan').prop('disabled', true);
            $('#formBiodata').addClass('d-none');
            $('#formAkun').removeClass('d-none');
            $('#linkAkun').addClass('active').addClass('disabled');
            $('#linkBiodata').addClass('disabled').removeClass('active');
        });

        // bs-custom-file-input
        $(document).ready(function () {
          bsCustomFileInput.init()
        });


        // menampilkan pas_foto preview
        function previewImage() {
          $('.border-image').removeClass('d-none');
          $('.kotak').remove();
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

</body>

</html>