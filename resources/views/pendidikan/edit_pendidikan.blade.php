@extends('layouts.main')

@section('title','SIDAKEP - Riwaya Pendidikan Edit')

@section('page-heading','Edit Riwayat Pendidikan')



@section('konten')
<div class="row justify-content-center">
    <div class="card col-md-7 shadow mb-4">
        <div class="card-body p-5">
          @if (session('sukses'))
                    
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('sukses') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
            <form method="POST" action="/pendidikan/{{ $pendidikan->id }}" enctype="multipart/form-data">
              @csrf
              @method('put')
                <div class="form-group">
                  @if (auth()->user()->status === '1')
                  <input type="hidden" name="pegawai_id" value="{{ auth()->user()->pegawai->id }}">
                  <fieldset disabled="disabled">

                    <label for="pegawai_id_display">Pegawai</label>
                    <select id="pegawai_id_display" name="pegawai_id_display" class="custom-select @error('pegawai_id_display') is-invalid @enderror">
                      <option value="">Pilih...</option>
                      @foreach ($pegawaiS as $pegawai)
                      <option value="{{ $pegawai->id }}" {{ auth()->user()->pegawai_id == $pegawai->id ? ' selected' : ' ' }}>{{ $pegawai->kd_pegawai }} - {{ $pegawai->nama }}</option>
                      @endforeach
                    
                      </select>
                      @error('pegawai_id')
                    <div id="validasiPegawaiId" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                    </fieldset>

                    @else
                    <input type="text" name="pegawai_id" value="{{ $pendidikan->pegawai_id }}" hidden>
                    <fieldset disabled="disabled">
                      <label for="pegawai_id">Pegawai</label>
                      <select id="pegawai_id" name="pegawai_id" class="custom-select @error('pegawai_id') is-invalid @enderror">
                      <option value="">Pilih...</option>
                      @foreach ($pegawaiS as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ old('pegawai_id', $pendidikan->pegawai_id) == $pegawai->id ? ' selected' : ' ' }} >{{ $pegawai->kd_pegawai }} - {{ $pegawai->nama }}</option>
                      @endforeach
                      </select>
                      @error('pegawai_id')
                      <div id="validasiPegawaiId" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </fieldset>
                    @endif
                    
                </div>
                <div class="form-row">
                  <div class="form-group col-md-5">
                    <label for="pendidikan">Pendidikan</label>
                    <select id="pendidikan" name="pendidikan" class="custom-select @error('pendidikan') is-invalid @enderror">
                        <option value="">Pilih...</option>
                        <option value="SMP" {{ old('pendidikan', $pendidikan->pendidikan) == 'SMA' ? ' selected' : ' ' }}>SMP</option>
                        <option value="SMA"  {{ old('pendidikan', $pendidikan->pendidikan) == 'SMP' ? ' selected' : ' ' }}>SMA</option>
                        <option value="SMK"  {{ old('pendidikan', $pendidikan->pendidikan) == 'SMK' ? ' selected' : ' ' }}>SMK</option>
                        <option value="D3"  {{ old('pendidikan', $pendidikan->pendidikan) == 'D3' ? ' selected' : ' ' }}>D3</option>
                        <option value="D4"  {{ old('pendidikan', $pendidikan->pendidikan) == 'D4' ? ' selected' : ' ' }}>D4</option>
                        <option value="S1"  {{ old('pendidikan', $pendidikan->pendidikan) == 'S1' ? ' selected' : ' ' }}>S1</option>
                        <option value="S2"  {{ old('pendidikan', $pendidikan->pendidikan) == 'S2' ? ' selected' : ' ' }}>S2</option>
                        <option value="S3"  {{ old('pendidikan', $pendidikan->pendidikan) == 'S3' ? ' selected' : ' ' }}>S3</option>
                    </select>
                    @error('pendidikan')
                    <div id="validasiPendidikan" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-7">
                    <label for="no_ijazah">No Ijazah</label>
                    <input type="text" name="no_ijazah" class="form-control @error('no_ijazah') is-invalid @enderror" id="no_ijazah" value="{{ old('no_ijazah', $pendidikan->no_ijazah) }}">
                    @error('no_ijazah')
                    <div id="validasiNoIjazah" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  
                </div>
                <div class="form-group">
                  <label for="nama_sekolah">Nama Sekolah / Institusi / Universitas</label>
                  <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" value="{{ old('nama_sekolah', $pendidikan->nama_sekolah) }}">
                  @error('nama_sekolah')
                  <div id="validasiNamaSekolah" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="custom-file mb-3">
                  <input type="file" class="custom-file-input @error('ijazah') is-invalid @enderror" name="ijazah" id="ijazah">
                  <label class="custom-file-label" for="ijazah">Upload ijazah</label>
                  @error('ijazah')
                  <div id="validasiCv" class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <small class=" text-muted">
                  <ul>
                    <li>Ijazah berupa pdf</li>
                    <li>Ijazah max 1 mb</li>
                    <li>Jangan upload ijazah jika tidak ingin diubah</li>
                  </ul>
                 </small>
                <div class="d-flex justify-content-end">

                  <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
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
  </script> 
@endsection