<?php

use Illuminate\Database\Seeder;
use App\KepalaSekolah;

class KepalaSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $xkepsek = [
            [
                'nama_kepsek' => 'Rachel Diana Rahajuningtyas, S.Pd',
                'jk'    => 'Perempuan',
                'agama' => 'Kristen',
                'alamat'    => 'Jl. Singosari No. 8 Malang',
                'no_telp' => '08523778754',
                'created_at'	=> now(),
			    'updated_at'	=> now(),
                'foto_profil' => 'miss_rachel.jpg',
                'user_id' => '2'
            ]
        ];

        foreach($xkepsek as $key => $value){
            KepalaSekolah::create($value);
        }
    }
}
