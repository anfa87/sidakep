<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $positions = Jabatan::all()->sortBy('nama_jabatan');
        return view('register',[
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        // validasi akun
        $validatedDataUser = $request->validate([
            // valdasi akun
            'username' => 'required|min:3|max:100|unique:users|alpha_dash',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:100|confirmed',
            'password_confirmation' => 'required|min:8|max:100'
        ],
        [
            // pesan validasi akun
            'username.required' => 'Harap isi username!',
            'username.min' => 'Username minimal 3 karakter!',
            'username.max' => 'Username maksimal 100 karakter!',
            'username.unique' => 'Username sudah digunakan!',
            'username.alpha_dash' => 'Username tidak boleh mengandung spasi!',
            'email.required' => 'Harap isi email!',
            'email.email' => 'Format email salah!',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'Harap isi password!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.max' => 'Password maksimal 100 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!',
            'password_confirmation.required' => 'Harap isi konfirmasi password!',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter!',
            'password_confirmation.max' => 'Konfirmasi password maksimal 100 karakter!'
        ]);

        // validasi biodata
        $validatedDataPegawai = $request->validate([
            
            // validasi biodata
            'pas_foto' => 'required|image|file|max:1024',
            'nama' => 'required|max:100',
            'nik' => 'required|size:16|unique:pegawai',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required|max:13',
            'jabatan_id' => 'required',
            'alamat' => 'required|max:255',
            'ktp' => 'required|mimes:pdf|file|max:1024',
            'kk' => 'required|mimes:pdf|file|max:1024',
            'akta_lahir' => 'required|mimes:pdf|file|max:1024',
            'cv' => 'required|mimes:pdf|file|max:1024'

        ],
        [
            
            // pesan validasi biodata
            'pas_foto.required' => 'Harap masukkan pas foto 3x4!',
            'pas_foto.image' => 'File harus berupa pas_foto!',
            'pas_foto.max' => 'Gambar max 1 mb',
            'nama.required' => 'Harap isi nama lengkap!',
            'nama.max' => 'Nama lengkap maksimal 100 karakter!',
            'nik.required' => 'Harap isi nik!',
            'nik.size' => 'Nik harus 16 karakter!',
            'nik.unique' => 'Nik sudah pernah digunakan!',
            'tempat_lahir.required' => 'Harap isi tempat lahir!',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter!',
            'tanggal_lahir.required' => 'Harap isi tanggal lahir!',
            'tanggal_lahir.date' => 'Format tanggal lahir salah!',
            'tanggal_masuk.required' => 'Harap isi tanggal masuk/diterima sebagai pegawai!',
            'tanggal_masuk.date' => 'Format tanggal salah!',
            'jenis_kelamin.required' => 'Harap pilih jenis kelamin!',
            'agama.required' => 'Harap pilih agama!',
            'no_hp.required' => 'Harap isi no hp!',
            'no_hp.max' => 'No hp maksimal 13 karakter!',
            'jabatan_id.required' => 'Harap pilih jabatan!',
            'alamat.required' => 'Harap isi alamat!',
            'alamat.max' => 'Alamat maksimal 255 karakter!',
            'ktp.required' => 'Harap upload berkas KTP!',
            'ktp.mimes' => 'Jenis berkas harus pdf !',
            'ktp.max' => 'Berkas KTP max 1 mb !',
            'kk.required' => 'Harap upload berkas KK!',
            'kk.mimes' => 'Jenis berkas harus pdf !',
            'kk.max' => 'Berkas KK max 1 mb !',
            'akta_lahir.required' => 'Harap upload berkas akta lahir!',
            'akta_lahir.mimes' => 'Jenis berkas harus pdf !',
            'akta_lahir.max' => 'Berkas akta lahir max 1 mb !',
            'cv.required' => 'Harap upload berkas CV!',
            'cv.mimes' => 'Jenis berkas harus pdf !',
            'cv.max' => 'Berkas CV max 1 mb !',


        ]);

        // hash password
        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);

        $countUser = User::all()->count();
        if ($countUser  == 0) {
            $validatedDataUser['status'] = '2';
        }

        // membuat kode awal dari kode pegawai
        $kode_awal = date('my',strtotime($validatedDataPegawai['tanggal_masuk'])).date('dmy',strtotime($validatedDataPegawai['tanggal_lahir']));

       

        // mwmbuat kode akhir dari kode pegawai
        $countPeg= Pegawai::all()->count();
        if ($countPeg == 0 ) {
            $validatedDataPegawai['kd_pegawai'] = $kode_awal.'001';
            
            
        } else {
            $employee = Pegawai::latest()->first();
            $kode_akhir = $employee->kd_pegawai;
            
            $kode_akhir = substr($kode_akhir,-3);
            $kode_akhir = $kode_akhir + 1;
            if (strlen($kode_akhir) == 3 ) {
                $kode_akhir = $kode_akhir;
            } elseif (strlen($kode_akhir) == 2)  {
                $kode_akhir = '0'. $kode_akhir;
            } else {
                $kode_akhir = '00'. $kode_akhir;
            }

            $validatedDataPegawai['kd_pegawai'] = $kode_awal.$kode_akhir;
            
        };

        
       
        // penyimpanan pas_foto
        $validatedDataPegawai['pas_foto'] = $request->file('pas_foto')->store('pas-foto/'.$validatedDataPegawai['kd_pegawai']);
        // penyimpanan ktp
        $validatedDataPegawai['ktp'] = $request->file('ktp')->store('ktp/'.$validatedDataPegawai['kd_pegawai']);
        // penyimpanan kk
        $validatedDataPegawai['kk'] = $request->file('kk')->store('kk/'.$validatedDataPegawai['kd_pegawai']);
        // penyimpanan akta_lahir
        $validatedDataPegawai['akta_lahir'] = $request->file('akta_lahir')->store('akta-lahir/'.$validatedDataPegawai['kd_pegawai']);
        // penyimpanan cv
        $validatedDataPegawai['cv'] = $request->file('cv')->store('cv/'.$validatedDataPegawai['kd_pegawai']);

        // create ke tabel employee
        Pegawai::create($validatedDataPegawai);   

        $pegawai = Pegawai::where('kd_pegawai', $validatedDataPegawai['kd_pegawai'])->first();

        $validatedDataUser['pegawai_id'] = $pegawai->id;

        // create ke tabel user
        User::create($validatedDataUser);
        
        return redirect('/login')->with('sukses', 'Akun berhasil didaftarkan, silahkan login!!');

    }
}
