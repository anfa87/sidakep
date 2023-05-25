<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            'kd_jabatan' => '00000',
            'nama_jabatan' => 'contoh jabatan',
        ]);
    }
}
