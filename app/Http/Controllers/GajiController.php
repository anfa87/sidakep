<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawaiS = Pegawai::all()->sortBy('nama');
        return view('gaji.index',[
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
            'gaji_pokok' => 'required',
            'tunjangan' => 'required',
            'potongan' => 'required',
            'no_rek' => 'required'
            
            
        ],
        [
            'pegawai_id.required' => 'Harap pilih pegawai!',
            'gaji_pokok.required' => 'Harap isi gaji pokok!',
            'tunjangan.required' => 'Harap isi tunjangan!',
            'potongan.required' => 'Harap isi potongan!',
            'no_rek.required' => 'Harap isi no rekening!'
            

            

        ]);


        Gaji::create($validatedData);

        return redirect('/gaji')->with('sukses', 'Data berhasil ditambahkan, harap cek pada data pegawai yang ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji)
    {

       
            $pegawaiS = Pegawai::all()->sortBy('nama');
            return view('gaji.edit_gaji',[
                'pegawaiS' => $pegawaiS,
                'gaji' => $gaji
            ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan' => 'required',
            'potongan' => 'required',
            'no_rek' => 'required'
            
            
        ],
        [
            'pegawai_id.required' => 'Harap pilih pegawai!',
            'gaji_pokok.required' => 'Harap isi gaji pokok!',
            'tunjangan.required' => 'Harap isi tunjangan!',
            'potongan.required' => 'Harap isi potongan!',
            'no_rek.required' => 'Harap isi no rekening!'
            

            

        ]);


        Gaji::where('id', $gaji->id)
        ->update($validatedData);

        return redirect('/pegawai/data-pegawai/'.$gaji->pegawai->kd_pegawai)->with('sukses', 'Data gaji berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaji $gaji)
    {
        Gaji::destroy($gaji->id);

        return redirect('/pegawai/data-pegawai/'.$gaji->pegawai->kd_pegawai)->with('sukses', 'Data gaji berhasil dihapus!');
    }
}
