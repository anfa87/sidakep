@extends('layouts.main')

@section('title','SIDAKEP - Data Users')

@section('css')
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" /> 
  <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-heading','Data Users')



@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Pegawai</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Pegawai</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->pegawai->kd_pegawai }}</td>
                            <td>{{ $user->username}}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ( $user->status == 2)
                                    Admin
                                @else
                                    User
                                @endif
                                
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ubahStatus{{ $user->id }}">Ubah status</button>
                                <form action="/users/{{ $user->id }}" class="d-inline-flex" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus? menghapus data user juga akan menghapus data pegawai!')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        {{-- modal ubah status --}}
                        <div class="modal fade" id="ubahStatus{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Ubah status</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/users/{{ $user->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="custom-select" name="status" onchange="submit()">
                                            <option value="1" {{ $user->status == 1 ? 'selected' : ' ' }}>User</option>
                                            <option value="2" {{ $user->status == 2 ? 'selected' : ' ' }}>Admin</option>
                                            
                                        </select>
                                    </form>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
@endsection