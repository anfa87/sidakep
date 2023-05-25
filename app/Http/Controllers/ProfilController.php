<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $profil)
    {
        if ($profil->kd_pegawai !== auth()->user()->pegawai->kd_pegawai) {
            abort(403);
        } else {
            return view('pegawai.detail',[
                'pegawai' => $profil
            ]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $profil)
    {
        
        $jabatanS = Jabatan::all()->sortBy('nama_jabatan');
        return view('pegawai.edit_pegawai',[
            'pegawai' => $profil,
            'jabatanS' => $jabatanS
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $profil)
    {
        // validasi 
        $validatedData = $request->validate([
            
            // validasi biodata
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required|max:13',
            'jabatan_id' => 'required',
            'alamat' => 'required|max:255',

        ],
        [
            
            // pesan validasi biodata
            'nama.required' => 'Harap isi nama lengkap!',
            'nama.max' => 'Nama lengkap maksimal 100 karakter!',
            
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
            'alamat.max' => 'Alamat maksimal 255 karakter!'
        ]);


        // validasi jika nik diubah
        if ($request->nik != $profil->nik) {

            $validatedData['nik'] = $request->validate([

                'nik' => 'required|size:16|unique:pegawai'
            
            ],
            [
                'nik.required' => 'Harap isi nik!',
                'nik.size' => 'Nik harus 16 karakter!',
                'nik.unique' => 'Nik sudah pernah digunakan!',
            ]);
        }


        if ($request->file('pas_foto')) {

            $validatedData['pas_foto'] = $request->validate([

                'pas_foto' => 'required|image|file|max:1024'
            
            ],
            [
                'pas_foto.required' => 'Harap masukkan pas foto 3x4!',
                'pas_foto.image' => 'File harus berupa gambar!',
                'pas_foto.max' => 'Gambar max 1 mb',
                
            ]);

            Storage::delete($profil->pas_foto);
            $validatedData['pas_foto'] = $request->file('pas_foto')->store('pas-foto/'.$profil->kd_pegawai);
        }

        if ($request->file('ktp')) {

            $validatedData['ktp'] = $request->validate([

                'ktp' => 'required|mimes:pdf|file|max:1024',
            
            ],
            [
                'ktp.required' => 'Harap upload berkas KTP!',
                'ktp.mimes' => 'Jenis berkas harus pdf !',
                'ktp.max' => 'Berkas KTP max 1 mb !',
                
            ]);

            Storage::delete($profil->ktp);
            $validatedData['ktp'] = $request->file('ktp')->store('ktp/'.$profil->kd_pegawai);
        }

        if ($request->file('kk')) {

            $validatedData['kk'] = $request->validate([

                'kk' => 'required|mimes:pdf|file|max:1024',
            
            ],
            [
                'kk.required' => 'Harap upload berkas Kartu keluarga!',
                'kk.mimes' => 'Jenis berkas harus pdf !',
                'kk.max' => 'Berkas Kartu keluarga max 1 mb !',
                
            ]);

            Storage::delete($profil->kk);
            $validatedData['kk'] = $request->file('kk')->store('kk/'.$profil->kd_pegawai);
        }

        if ($request->file('akta_lahir')) {

            $validatedData['akta_lahir'] = $request->validate([

                'akta_lahir' => 'required|mimes:pdf|file|max:1024',
            
            ],
            [
                'akta_lahir.required' => 'Harap upload berkas akta lahir!',
                'akta_lahir.mimes' => 'Jenis berkas harus pdf !',
                'akta_lahir.max' => 'Berkas akta lahir max 1 mb !',
                
            ]);

            

            Storage::delete($profil->akta_lahir);
            $validatedData['akta_lahir'] = $request->file('akta_lahir')->store('akta-lahir/'.$profil->kd_pegawai);
        }

        if ($request->file('cv')) {

            $validatedData['cv'] = $request->validate([

                'cv' => 'required|mimes:pdf|file|max:1024',
            
            ],
            [
                'cv.required' => 'Harap upload berkas CV!',
                'cv.mimes' => 'Jenis berkas harus pdf !',
                'cv.max' => 'Berkas CV max 1 mb !',
                
            ]);

            Storage::delete($profil->cv);
            $validatedData['cv'] = $request->file('cv')->store('cv/'.$profil->kd_pegawai);
        }

        Pegawai::where('id', $profil->id)
        ->update($validatedData);

        return redirect('/profil/'.$profil->kd_pegawai.'/edit')->with('sukses', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }

    public function updateAkun(Request $request, User $user)
    {

       

        // validasi jika username diubah
        if ($request->username != $user->username) {

            $validatedData['username'] = $request->validate([

                'username' => 'required|alpha_dash|min:3|max:100|unique:users',
              
            ],
            [
                'username.required' => 'Harap isi username!',
                'username.min' => 'Username minimal 3 karakter!',
                'username.max' => 'Username maksimal 100 karakter!',
                'username.unique' => 'Username sudah digunakan!',
                'username.alpha_dash' => 'Username tidak boleh mengandung spasi!'
            ]);
        }

        // validasi jika email diubah
        if ($request->email != $user->email) {

            $validatedData['email'] = $request->validate([

                'email' => 'required|email:dns|unique:users'
            
            ],
            [
                'email.required' => 'Harap isi email!',
                'email.email' => 'Format email salah!',
                'email.unique' => 'Email sudah digunakan!'
            ]);
        }

       

        if ($request->email != $user->email AND $request->username != $user->username) {
            User::where('id', $user->id)->update($validatedData['email']);
            User::where('id', $user->id)->update($validatedData['username']);
        } elseif ($request->username != $user->username) {
            User::where('id', $user->id)->update($validatedData['username']);
        } elseif ($request->email != $user->email) {
            User::where('id', $user->id)->update($validatedData['email']);
        }

        
        

        return redirect('/profil/'.$user->pegawai->kd_pegawai)->with('sukses', 'Data akun berhasil diupdate!');
    }
}
