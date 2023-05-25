<?php

namespace App\Http\Controllers;


use App\Models\Gaji;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;

 
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawaiS = Pegawai::all();
        return view('pegawai.index',[
            'pegawaiS' => $pegawaiS
        ]);
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

    public function pratinjauKtp(Pegawai $pegawai)
    {
        return view('pegawai.pratinjau-ktp',[
            'pegawai' => $pegawai
        ]);
    }

    public function pratinjauKk(Pegawai $pegawai)
    {
        return view('pegawai.pratinjau-kk',[
            'pegawai' => $pegawai
        ]);
    }

    public function pratinjauAkta(Pegawai $pegawai)
    {
        return view('pegawai.pratinjau-akta',[
            'pegawai' => $pegawai
        ]);
    }

    public function pratinjauCv(Pegawai $pegawai)
    {
        return view('pegawai.pratinjau-cv',[
            'pegawai' => $pegawai
        ]);
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
    public function show(Pegawai $data_pegawai)
    {

        return view('pegawai.detail',[
            'pegawai' => $data_pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $data_pegawai)
    {
        $jabatanS = Jabatan::all()->sortBy('nama_jabatan');
        return view('pegawai.edit_pegawai',[
            'pegawai' => $data_pegawai,
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
    public function update(Request $request, Pegawai $data_pegawai)
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
        if ($request->nik != $data_pegawai->nik) {

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

            Storage::delete($data_pegawai->pas_foto);
            $validatedData['pas_foto'] = $request->file('pas_foto')->store('pas-foto/'.$data_pegawai->kd_pegawai);
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

            Storage::delete($data_pegawai->ktp);
            $validatedData['ktp'] = $request->file('ktp')->store('ktp/'.$data_pegawai->kd_pegawai);
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

            Storage::delete($data_pegawai->kk);
            $validatedData['kk'] = $request->file('kk')->store('kk/'.$data_pegawai->kd_pegawai);
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

            

            Storage::delete($data_pegawai->akta_lahir);
            $validatedData['akta_lahir'] = $request->file('akta_lahir')->store('akta-lahir/'.$data_pegawai->kd_pegawai);
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

            Storage::delete($data_pegawai->cv);
            $validatedData['cv'] = $request->file('cv')->store('cv/'.$data_pegawai->kd_pegawai);
        }

        Pegawai::where('id', $data_pegawai->id)
        ->update($validatedData);

        return redirect('/pegawai/data-pegawai/'.$data_pegawai->kd_pegawai.'/edit')->with('sukses', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $data_pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $data_pegawai)
    {

        
        foreach ($data_pegawai->pendidikanS as $pendidikan) {
            Storage::delete($pendidikan->ijazah);
        }
      
        Storage::delete($data_pegawai->ktp);
        Storage::delete($data_pegawai->kk);
        Storage::delete($data_pegawai->akta_lahir);
        Storage::delete($data_pegawai->cv);


        Gaji::destroy($data_pegawai->id);
        Pendidikan::destroy($data_pegawai->id);
        User::destroy($data_pegawai->user->id);
        Pegawai::destroy($data_pegawai->id);

        return redirect('/pegawai/data-pegawai')->with('sukses', 'Data berhasil dihapus!');
    }

    

    public function laporan()
    {

        $pegawaiS = Pegawai::all();
        
        
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('f4', 'landscape');
        $pdf->loadView('pegawai.laporan',['pegawaiS' => $pegawaiS])->setOptions(['defaultFont' => 'sans-serif']);

    	return $pdf->download('laporan-pegawai-.pdf');
    }
}