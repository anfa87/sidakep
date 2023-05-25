<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatanS = Jabatan::all();
        return view('jabatan.index',[
            'jabatanS' => $jabatanS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'kd_jabatan' => 'required|unique:jabatan',
            'nama_jabatan' => 'required|max:100|',
            
            
        ],
        [
            'kd_jabatan.required' => 'Harap masukkan kode jabatan!',
            'kd_jabatan.unique' => 'Kode jabatan '.$request->kd_jabatan. ' sudah digunakan!',
            'nama_jabatan.required' => 'Harap masukkan nama jabatan!',
            'nama_jabatan.max' => 'Nama jabatan maksimal 100 karakter!',
            

        ]);

        Jabatan::create($validatedData);

        return redirect('/jabatan')->with('sukses', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {


        if ($request->kd_jabatan == $jabatan->kd_jabatan) {
            $validatedData = $request->validate([
                'kd_jabatan' => 'required',
                'nama_jabatan' => 'required|max:100|',
                
                
            ],
            [
                'kd_jabatan.required' => 'Harap masukkan kode jabatan!',
                'nama_jabatan.required' => 'Harap masukkan nama jabatan!',
                'nama_jabatan.max' => 'Nama jabatan maksimal 100 karakter!',
                
                
    
            ]);
        } else {
            $validatedData = $request->validate([
                'kd_jabatan' => 'required|unique:jabatan',
                'nama_jabatan' => 'required|max:100|',
                
                
            ],
            [
                'kd_jabatan.required' => 'Harap masukkan kode jabatan!',
                'kd_jabatan.unique' => 'Kode jabatan ' .$request->kd_jabatan. ' sudah digunakan!',
                'nama_jabatan.required' => 'Harap masukkan nama jabatan!',
                'nama_jabatan.max' => 'Nama jabatan maksimal 100 karakter!',
                
    
            ]);
    
        }

        
        
        Jabatan::where('id', $jabatan->id)
            ->update($validatedData);

        return redirect('/jabatan')->with('sukses', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        Jabatan::destroy($jabatan->id);

        return redirect('/jabatan')->with('sukses', 'Data berhasil dihapus!');
    }
}
