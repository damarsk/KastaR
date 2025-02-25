<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'DaMart',
            'alamat' => 'Jl. Gading Junti Asri Blok M2 No.55, Kabupaten Bandung',
            'telepon' => '087731043392',
            'tipe_nota' => '1', // Small
            'diskon' => '0',
            'path_logo' => 'land_style/img/logo.png',
            'path_kartu_member' => 'images/member.png',
        ]);
    }
}
