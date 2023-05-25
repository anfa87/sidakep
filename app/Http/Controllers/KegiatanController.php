<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatanS = Kegiatan::all()->sortBy('waktu');
        return view('kegiatan.index',[
            'kegiatanS' => $kegiatanS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kegiatan.tambah_kegiatan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            
            // validasi
            'pegawai_id' => 'required',
            'judul' => 'required|max:255',
            'waktu' => 'required|date',
            'gambar' => 'required|image|file|max:2024',
            'keterangan' => 'required|max:255',
            

        ],
        [
            
            // pesan validasi
            'judul.required' => 'Harap masukkan judul!',
            'judul.max' => 'Judul maksimal 255 karakter!',
            'waktu.required' => 'Harap masukkan waktu kegiatan!',
            'waktu.date' => 'Format tanggal salah!',
            'gambar.required' => 'Harap masukkan foto kegiatan!',
            'gambar.image' => 'File harus berupa gambar!',
            'gambar.max' => 'Gambar max 2 mb',
            'keterangan.required' => 'Harap masukkan keterangan!',
            'keterangan.max' => 'Keterangan maksimal 255 karakter!',
            
        ]);

        $pegawai = Pegawai::where('id', $validatedData['pegawai_id'])->first();

        $kode_pegawai = $pegawai->kd_pegawai;

         // membuat penyimpanan gambar
         $validatedData['gambar'] = $request->file('gambar')->store('foto-kegiatan/'.$kode_pegawai);

         // create ke tabel kegiatan
        Kegiatan::create($validatedData);
        
        return redirect('/kegiatan')->with('sukses', 'Data berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {

        if ($kegiatan->pegawai_id !== auth()->user()->pegawai->id) {
            abort(403);
        } else {

            return view('kegiatan.edit_kegiatan',[
                'kegiatan' => $kegiatan
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        // validasi
        $validatedData = $request->validate([
            
            // validasi
           
            'judul' => 'required|max:255',
            'waktu' => 'required|date',
            
            'keterangan' => 'required|max:255',
            

        ],
        [
            
            // pesan validasi
            'judul.required' => 'Harap masukkan judul!',
            'judul.max' => 'Judul maksimal 255 karakter!',
            'waktu.required' => 'Harap masukkan waktu kegiatan!',
            'waktu.date' => 'Format tanggal salah!',
           
            'keterangan.required' => 'Harap masukkan keterangan!',
            'keterangan.max' => 'Keterangan maksimal 255 karakter!',
            
        ]);

        if ($request->file('gambar')) {

            $validatedData['gambar'] = $request->validate([

                'gambar' => 'required|image|file|max:2024',
            
            ],
            [
                'gambar.required' => 'Harap masukkan foto kegiatan!',
                'gambar.image' => 'File harus berupa gambar!',
                'gambar.max' => 'Gambar max 2 mb',
                
            ]);

            Storage::delete($kegiatan->gambar);

            $pegawai = Pegawai::where('id', $kegiatan->pegawai_id)->first();

            $kode_pegawai = $pegawai->kd_pegawai;
    
             // membuat penyimpanan gambar
             $validatedData['gambar'] = $request->file('gambar')->store('foto-kegiatan/'.$kode_pegawai);

          
        }

       

       
        Kegiatan::where('id', $kegiatan->id)
        ->update($validatedData);

        return redirect('/kegiatan')->with('sukses', 'Data berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        Storage::delete($kegiatan->gambar);
    

      
        
        Kegiatan::destroy($kegiatan->id);

        return redirect('/kegiatan')->with('sukses', 'Data berhasil dihapus!');
    
    }
}
