@extends('layouts.main')

@section('title','SIDAKEP - Gaji')

@section('page-heading','Form Gaji')



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
            <form method="POST" action="/gaji" >
              @csrf
              
                <div class="form-group">
                  

                
                      <label for="pegawai_id">Pegawai</label>
                      <select id="pegawai_id" name="pegawai_id" class="custom-select @error('pegawai_id') is-invalid @enderror">
                      <option value="">Pilih...</option>
                      @foreach ($pegawaiS as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ old('pegawai_id') == $pegawai->id ? ' selected' : ' ' }} class="{{ $pegawai->gaji->count() >= 1 ? ' d-none' : ' ' }}" >{{ $pegawai->kd_pegawai }} - {{ $pegawai->nama }}</option>
                      @endforeach
                      </select>
                      @error('pegawai_id')
                      <div id="validasiPegawaiId" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                   
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" value="{{ old('gaji_pokok') }}">
                        @error('gaji_pokok')
                        <div id="validasiGajiPokok" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                  <div class="form-group col-md-6">
                    <label for="tunjangan">Tunjangan</label>
                    <input type="number" name="tunjangan" class="form-control @error('tunjangan') is-invalid @enderror" id="tunjangan" value="{{ old('tunjangan') }}">
                    @error('tunjangan')
                    <div id="validasiTunjangan" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="potongan">Potongan</label>
                        <input type="number" name="potongan" class="form-control @error('potongan') is-invalid @enderror" id="potongan" value="{{ old('potongan') }}">
                        @error('potongan')
                        <div id="validasiPotongan" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                  <div class="form-group col-md-6">
                    <label for="no_rek">No Rekening BJB</label>
                    <input type="text" name="no_rek" class="form-control @error('no_rek') is-invalid @enderror" id="no_rek" value="{{ old('no_rek') }}">
                    @error('no_rek')
                    <div id="validasiNoRek" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  
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
  </script> 
@endsection