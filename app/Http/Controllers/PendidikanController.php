<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawaiS = Pegawai::all()->sortBy('nama');
        return view('pendidikan.index',[
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


    public function pratinjauIjazah(Pendidikan $pendidikan)
    {
        if ($pendidikan->pegawai->id === auth()->user()->pegawai_id) {
            return view('pendidikan.pratinjau-ijazah',[
                'pendidikan' => $pendidikan
            ]);
        } else {
            abort('403');
        }

       
        

        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'pendidikan' => 'required',
            'no_ijazah' => 'required',
            'nama_sekolah' => 'required',
            'ijazah' => 'required|mimes:pdf|file|max:1024'
            
            
        ],
        [
            'pegawai_id.required' => 'Harap pilih pegawai!',
            'nama_jabatan.required' => 'Harap pilih jenjang pendidikan!',
            'no_ijazah.required' => 'Harap masukkan no ijazah!',
            'nama_sekolah.required' => 'Harap masukkan nama sekolah/institusi/universitas!',
            'ijazah.required' => 'Harap upload ijazah!',
            'ijazah.mimes' => 'Jenis berkas harus pdf !',
            'ijazah.max' => 'Berkas ijazah max 1 mb !'

            

        ]);

        $pegawai = Pegawai::where('id', $request->pegawai_id)->first();

         // penyimpanan ijazah
         $validatedData['ijazah'] = $request->file('ijazah')->store('ijazah/'.$pegawai->kd_pegawai);

        Pendidikan::create($validatedData);

        return redirect('/pendidikan')->with('sukses', 'Data berhasil ditambahkan, harap cek pada profil pegawai yang ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendidikan $pendidikan)
    {
        if (auth()->user()->status != 2 AND $pendidikan->pegawai_id != auth()->user()->pegawai->id ) {
            abort('403');
        } else {
            $pegawaiS = Pegawai::all()->sortBy('nama');
            return view('pendidikan.edit_pendidikan',[
                'pegawaiS' => $pegawaiS,
                'pendidikan' => $pendidikan
            ]);
        }
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'pendidikan' => 'required',
            'no_ijazah' => 'required',
            'nama_sekolah' => 'required'
            
            
            
        ],
        [
            'pegawai_id.required' => 'Harap pilih pegawai!',
            'nama_jabatan.required' => 'Harap pilih jenjang pendidikan!',
            'no_ijazah.required' => 'Harap masukkan no ijazah!',
            'nama_sekolah.required' => 'Harap masukkan nama sekolah/institusi/universitas!'
           

            

        ]);

        if ($request->file('ijazah')) {

            $validatedData['ijazah'] = $request->validate([

                'ijazah' => 'required|mimes:pdf|file|max:1024'
            
            ],
            [
                'ijazah.required' => 'Harap upload ijazah!',
                'ijazah.mimes' => 'Jenis berkas harus pdf !',
                'ijazah.max' => 'Berkas ijazah max 1 mb !'
                
            ]);

            Storage::delete($pendidikan->ijazah);

            $pegawai = Pegawai::where('id', $pendidikan->pegawai_id)->first();

            $kode_pegawai = $pegawai->kd_pegawai;
    
             // membuat penyimpanan ijazah
             $validatedData['ijazah'] = $request->file('ijazah')->store('ijazah/'.$kode_pegawai);

          
        }

        pendidikan::where('id', $pendidikan->id)
        ->update($validatedData);

        return redirect('/pendidikan/'.$pendidikan->id.'/edit')->with('sukses', 'Data berhasil diupdate!!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {

      
        Storage::delete($pendidikan->ijazah);
    

      
        
        Pendidikan::destroy($pendidikan->id);

        return redirect('/profil/'.$pendidikan->pegawai->kd_pegawai)->with('sukses', 'Data pendidikan berhasil dihapus!');
    }

    public function hapusPendidikan(Pendidikan $pendidikan)
    {

      
        Storage::delete($pendidikan->ijazah);
    

      
        
        Pendidikan::destroy($pendidikan->id);

        return redirect('/pegawai/data-pegawai/'.$pendidikan->pegawai->kd_pegawai)->with('sukses', 'Data pendidikan berhasil dihapus!');
    }
}
