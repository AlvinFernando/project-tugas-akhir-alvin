<?php

use Illuminate\Database\Seeder;
use App\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $gurus = [
            [
                'kode_guru'    => 'K-120',
                'nama_guru' => 'Rachel Diana Rahajuningtyas, S.Pd',
                'jk'    => 'Perempuan',
                'agama' => 'Kristen',
                'alamat'    => 'Jl. Singosari No. 8 Malang',
                'no_telp' => '08523778754',
                'created_at'	=> now(),
			    'updated_at'	=> now(),
                'foto_profil' => 'miss_rachel.jpg',
                'user_id' => '5'
            ],
            [
                'kode_guru'    => 'K-122',
                'nama_guru' => 'Guru',
                'jk'    => 'Laki-Laki',
                'agama' => 'Kristen',
                'alamat'    => 'Perum. Malang Anggun Sejahtera Blok-120 Lawang',
                'no_telp' => '089644328858',
                'created_at'	=> now(),
			    'updated_at'	=> now(),
                'foto_profil' => 'default.jpg',
                'user_id' => '3'
            ]
        ];

        foreach($gurus as $key => $value){
            Guru::create($value);
        }
    }
}
