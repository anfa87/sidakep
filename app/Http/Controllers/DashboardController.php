<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $pegawaiS = Pegawai::all();
        return view('index',[
            'pegawaiS' => $pegawaiS
        ]);
    }
}
