@extends('layouts.main')

@section('title','SIDAKEP - Edit Kegiatan')

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-heading','Edit Kegiatan')



@section('konten')
<div class="row justify-content-center">
    <div class="card col-7 shadow mb-4">
        <div class="card-body p-5">
          @if (session('sukses'))
                    
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('sukses') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
            <form method="POST" action="/kegiatan/{{ $kegiatan->id }}" enctype="multipart/form-data">
              @csrf
                @method('put')
                <div class="form-row mb-2">
                    <div class="form-group col-md-8">
                        

                        <label for="judul">Judul Kegiatan</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" value="{{ old('judul', $kegiatan->judul) }}">
                        @error('judul')
                        <div id="validasiJudul" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="waktu">Waktu</label>
                        <input type="date" name="waktu" class="form-control @error('waktu') is-invalid @enderror" id="waktu" value="{{ old('waktu', $kegiatan->waktu) }}">
                        @error('waktu')
                        <div id="validasiWaktu" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar" name="gambar"  onchange="previewImage()">
                            <label class="custom-file-label" for="gambar" >Pilih foto kegiatan</label>
                            @error('gambar')
                            <div id="validasiGambar" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-md-6 gambar-kedua d-none">
                          <img class="img-preview-kegiatan" style="width: 250px">
                    </div>
                    <div class="col-md-6 img-old"">
                        <img style="width: 250px" src="/storage/{{ $kegiatan->gambar }}" alt="Foto {{ $kegiatan->judul }}">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{ old('keterangan', $kegiatan->keterangan) }}">
                    @error('keterangan')
                    <div id="validasiKeterangan" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                </div>
                
                

                    <button type="submit" class="btn btn-primary">Simpan</button>
                
            </form>
        </div>
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


        // menampilkan gambar preview
        function previewImage() {
          $('.gambar-kedua').removeClass('d-none');
          $('.img-old').addClass('d-none');
          const image = document.querySelector('#gambar');
          const imgPreview = document.querySelector('.img-preview-kegiatan');
          
          
          imgPreview.style.display = 'block';

          const oFReader  = new FileReader();
          oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
              imgPreview.src = oFREvent.target.result;
           }

        };
   </script>
@endsection