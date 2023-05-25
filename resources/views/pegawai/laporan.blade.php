<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>SIDAKEP - Laporan Data Pegawai</title>
    
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 7pt;
		}


        .table {
                color: #232323;
                border-collapse: collapse;
            }

            .table, th, td {
                border: 1px solid #999;
                padding: 5px 5px;
            }
 	</style>
 </head>

<body>
    
    <div>
        <center>

            <h3 style="margin-bottom: -5px ; padding-bottom:0px">Laporan Data Pegawai Non ASN</h3>
            <h3>Dinas Pemuda dan Olahraga Provinsi Jawa Barat</h3>
			
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pegawai</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>No Hp</th>
                    <th>Tanggal Masuk</th>
                    <th>Alamat</th>
                    <th>Gaji</th>
                    <th>Jabatan</th>
                    <th>Pendidikan</th>
                    <th>Nama Sekolah/Institusi/Universitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawaiS as $pegawai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pegawai->kd_pegawai }}</td>
                       
                        <td>{{ $pegawai->nik }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir }}</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                        <td>{{ $pegawai->agama }}</td>
                        <td>{{ $pegawai->no_hp }}</td>
                        <td>{{ $pegawai->tanggal_masuk }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>Rp  {{ $pegawai->gaji->count() == 0 ? '-' : number_format($pegawai->gaji->last()->gaji_pokok + $pegawai->gaji->last()->tunjangan - $pegawai->gaji->last()->potongan ,2,',','.') }}</td>
                        <td>{{ $pegawai->jabatan->nama_jabatan }}</td>
                        <td>{{ $pegawai->pendidikanS->count() == 0 ? '-' : $pegawai->pendidikanS->last()->pendidikan }}</td>
                        <td>{{ $pegawai->pendidikanS->count() == 0 ? '-' : $pegawai->pendidikanS->last()->nama_sekolah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </center>

    </div>


   

</body>

</html>