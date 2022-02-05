<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admins = [
            [
                'nama_admin' => 'Admin',
                'created_at'	=> now(),
			    'updated_at'	=> now(),
                'foto_profil' => 'default.jpg',
                'user_id' => '1'
            ]
        ];

        foreach($admins as $key => $value){
            Admin::create($value);
        }
    }
}
