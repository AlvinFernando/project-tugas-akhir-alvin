<?php

use Illuminate\Database\Seeder;
use App\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $siswas = [
            [
                'no_induk'    => '100',
                'nama_siswa' => 'Siswa',
                'kelas_id' => '1',
                'guru_id' => '2',
                'jk'    => 'Laki-Laki',
                'agama' => 'Kristen',
                'alamat'    => 'Perum. Malang Anggun Sejahtera Blok-120 Lawang',
                'no_telp' => '089644328858',
                'created_at'	=> now(),
			    'updated_at'	=> now(),
                'foto_profil' => 'default.jpg',
                'user_id' => '4',
                'nama_ayah' => 'Ayah123',
                'nama_ibu' => 'Ibu123',
                'nama_wali' => 'Wali123',
            ]
        ];

        foreach($siswas as $key => $value){
            Siswa::create($value);
        }
    }
}
