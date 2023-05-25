@extends('layouts.main')

@section('title', Request::is('pegawai/data-pegawai*') ? 'SIDAKEP - Detail Data Pegawai'.auth()->user()->pegawai->nama.' '.auth()->user()->pegawai->kd_pegawai : 'SIDAKEP - Profil '.auth()->user()->pegawai->nama.' '.auth()->user()->pegawai->kd_pegawai)

@section('css')
 <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-heading','Detail Data Pegawai')



@section('konten')

        @if (session('sukses'))
                    
          <div class="alert alert-success col-md-5 alert-dismissible fade show" role="alert">
              {{ session('sukses') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger col-md-5 alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link pegawai active" href="#">Data Pegawai</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pendidikan" href="#">Riwayat Pendidikan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link gaji" href="#">Gaji</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="data-pegawai">

                <div class="py-3">
                  
                  <div id="gambarPreview" class="border-image mx-auto d-block">
                    <img class="img-preview " src="/storage/{{ $pegawai->pas_foto }}" alt="pas foto {{ $pegawai->nama }}  {{ $pegawai->kd_jabatan }}" >
                    
                  </div>
                  
                </div>
                
                  <form action="/profil/user/{{ auth()->user()->id }}" method="post">
                    @csrf
                   
                    <div class="row justify-content-center">
                      <div id="username" class="form-group col-md-3 d-none">

                        <input type="text" name="username" class=" form-control form-control-sm " value="{{ $pegawai->user->username }}">
                       
                      </div>
                      <div class="form-group">

                        <span class="username text-gray-900"><strong>{{ $pegawai->user->username  }}</strong></span>
                        <button id="btnUsername" type="button" class="badge bg-success border-0 ml-2"><i class="far fa-edit fa-fw" style="color: white ; font-size:14px"></i></button> 
                        <button id="simpanUsername" type="submit" class="badge bg-primary border-0 ml-2 mt-1 d-none"><i class="fas fa-check fa-fw" style="color: white ; font-size:14px"></i></button>
                        <button id="batalUsername" type="button" class="badge bg-danger border-0 ml-2  mt-1 d-none"><i class="fas fa-times fa-fw" style="color: white ; font-size:14px"></i></button>
                      </div>
                    </div>
                   
                     
                     
                  
                    <div class="row justify-content-center mb-2">
                      <div id="email" class="form-group co-md-3 d-none">
                        <input type="text"  name="email" class="form-control form-control-sm " value="{{ $pegawai->user->email }}">
                      </div>
                      <div class="form-group">

                        <span class="text-secondary email">{{ $pegawai->user->email }}</span> 
                        <button id="btnEmail" class="badge bg-success border-0 ml-2"><i class="far fa-edit fa-fw" style="color: white ; font-size:14px"></i></button>
                        <button id="simpanEmail" type="submit" class="badge bg-primary border-0 ml-2  mt-1 d-none"><i class="fas fa-check fa-fw" style="color: white ; font-size:14px"></i></button>
                        <button id="batalEmail" type="button" class="badge bg-danger border-0 ml-2  mt-1 d-none"><i class="fas fa-times fa-fw" style="color: white ; font-size:14px"></i></button>
                      </div>
                    </div>
                  </form>
                 
                  
                
                <hr>
                
                <div class="row">
                  
                  <div class="col-md-6 mt-4">
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Nama Lengkap</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->nama }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Kode Pegawai</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->kd_pegawai }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">NIK</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->nik }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Tempat, Tanggal Lahir</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->tempat_lahir }}, {{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Jenis Kelamin</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->jenis_kelamin }}
                      </div>
                    </div>
                    <hr>
                    
                  </div>
                  <div class="col-md-6 mt-4">
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">No Hp</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->no_hp }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Jabatan</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->jabatan->nama_jabatan }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Tanggal Masuk</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ date('d-m-Y',strtotime($pegawai->tanggal_masuk)) }}
                      </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Alamat</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $pegawai->alamat }}
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-gray-900">Berkas</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        <a href="/pratinjau/ktp/{{$pegawai->kd_pegawai}}" class="badge badge-primary" target='_blank'>KTP</a>
                        <a href="/pratinjau/kk/{{$pegawai->kd_pegawai}}" class="badge badge-primary" target='_blank'>Kartu Keluarga</a>
                        <a href="/pratinjau/akta_lahir/{{$pegawai->kd_pegawai}}" class="badge badge-primary" target='_blank'>Akta Lahir</a>
                        <a href="/pratinjau/cv/{{$pegawai->kd_pegawai}}" class="badge badge-primary" target='_blank'>CV</a>


                      </div>
                     
                    </div>
                    <hr>
                    
                  </div>
                </div>
            
               
                <a href="{{ Request::is('pegawai/data-pegawai*') ? '/pegawai/data-pegawai/'.$pegawai->kd_pegawai.'/edit' : '/profil/'. $pegawai->kd_pegawai.'/edit' }}" class="btn btn-sm btn-success mt-2">Edit</a>
              </div>

              <div class="table-responsive riwayat-pendidikan d-none">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Pendidikan</th>
                      <th scope="col">No Ijazah</th>
                      <th scope="col">Ijazah</th>
                      <th scope="col">Nama Sekolah/Institusi/Universitas</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pegawai->pendidikanS as $pendidikan)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                      
                        <td>{{ $pendidikan->pendidikan }}</td>
                        <td>{{ $pendidikan->no_ijazah }}</td>
                        <td>
                          <a href="/pratinjau/ijazah/{{$pendidikan->id}}" target='_blank' ><i class="fas fa-file-pdf" style="color: red ; font-size:40px"></i></a>
                        </td>
                        <td>{{ $pendidikan->nama_sekolah }}</td>
                        <td>
                          <a href="/pendidikan/{{ $pendidikan->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                          <form action="{{ Request::is('profil/*') ? '/pendidikan/'.$pendidikan->id : '/pegawai/data-pegawai/pendidikan/'.$pendidikan->id}}" class="d-inline-flex" method="POST">
                              @csrf
                              @if (Request::is('profil/*'))
                                @method('delete')
                                  
                              @endif
                             
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                   
                  
                  </tbody>
                </table>
              </div>

              <div class="table-responsive data-gaji d-none">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Gaji Pokok</th>
                      <th scope="col">Tunjangan</th>
                      <th scope="col">Potongan</th>
                      <th scope="col">Total Gaji</th>
                      <th scope="col">No Rekening BJB</th>
                      @if (auth()->user()->status == 2)
                      <th scope="col">Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    
                     <tr>
                      @foreach ($pegawai->gaji as $gaji)
                          
                      <td>Rp {{number_format($gaji->gaji_pokok,2,',','.') }} .</td>
                      <td>Rp {{number_format($gaji->tunjangan,2,',','.') }}</td>
                      <td>Rp {{number_format($gaji->potongan,2,',','.') }}</td>
                      <td>Rp  {{number_format($gaji->gaji_pokok + $gaji->tunjangan - $gaji->potongan ,2,',','.') }}</td>
                      <td>{{ $gaji->no_rek }}</td>
                      @if (auth()->user()->status == 2)
                      <td>
                        <a href="/gaji/{{ $gaji->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                        <form action="/gaji/{{ $gaji->id }}" class="d-inline-flex" method="POST">
                            @csrf
                            
                            @method('delete')
                                
                        
                           
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                      </td>
                      @endif
                      @endforeach

                     </tr>
                   
                  
                  </tbody>
                </table>
               
              </div>
            </div>

            
          </div>
            
@endsection

@section('javascript')
   <script>
     $('.pendidikan').click(function (e) { 
            e.preventDefault();
            $('.data-pegawai').addClass('d-none');
            $('.data-gaji').addClass('d-none');
            $('.riwayat-pendidikan').removeClass('d-none');
            $('.pegawai').removeClass('active');
            $('.gaji').removeClass('active');
            $(this).addClass('active');
           
        });

        $('.pegawai').click(function (e) { 
            e.preventDefault();
            $('.data-pegawai').removeClass('d-none');
            $('.riwayat-pendidikan').addClass('d-none');
            $('.data-gaji').addClass('d-none');
            $('.pendidikan').removeClass('active');
            $('.gaji').removeClass('active');
            $(this).addClass('active');
           
        });

        $('.gaji').click(function (e) { 
            e.preventDefault();
            $('.data-gaji').removeClass('d-none');
            $('.riwayat-pendidikan').addClass('d-none');
            $('.data-pegawai').addClass('d-none');
            $('.pendidikan').removeClass('active');
            $('.pegawai').removeClass('active');
            $(this).addClass('active');
           
        });

        $('#btnUsername').click(function (e){
          e.preventDefault();
          $(this).addClass('d-none');
          $('.username').addClass('d-none');
          $('#simpanUsername').removeClass('d-none');
          $('#batalUsername').removeClass('d-none');
          $('#username').removeClass('d-none');

        })

        $('#btnEmail').click(function (e){
          e.preventDefault();
          $(this).addClass('d-none');
          $('.email').addClass('d-none');
          $('#simpanEmail').removeClass('d-none');
          $('#batalEmail').removeClass('d-none');
          $('#email').removeClass('d-none');

        })

        $('#batalEmail').click(function (e){
          e.preventDefault();
          $(this).addClass('d-none');
          $('.email').removeClass('d-none');
          $('#btnEmail').removeClass('d-none');
          $('#simpanEmail').addClass('d-none');
          $('#email').addClass('d-none');

        })

        $('#batalUsername').click(function (e){
          e.preventDefault();
          $(this).addClass('d-none');
          $('.username').removeClass('d-none');
          $('#btnUsername').removeClass('d-none');
          $('#simpanUsername').addClass('d-none');
          $('#username').addClass('d-none');

        })

   </script>
@endsection