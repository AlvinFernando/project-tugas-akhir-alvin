<?php

use Illuminate\Database\Seeder;
use App\User;
Use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'name'    => 'Admin',
                'level' => 'admin',
                'email'    => 'admin@skpk.id',
                'remember_token' => Str::random(60),
                'password'    => bcrypt('admin1234')
            ],
            [
                'name'    => 'Rachel Diana Rahajuningtyas, S.Pd',
                'level' => 'kepsek',
                'email'    => 'racheldiana_kepsek@skpk.id',
                'remember_token' => Str::random(60),
                'password'    => bcrypt('kepsek1234')
            ],
            [
                'name'    => 'Guru',
                'level' => 'guru',
                'email'    => 'guru@skpk.id',
                'remember_token' => Str::random(60),
                'password'    => bcrypt('guru1234')
            ],
            [
                'name'    => 'Siswa',
                'level' => 'siswa',
                'email'    => 'siswa@skpk.id',
                'remember_token' => Str::random(60),
                'password'    => bcrypt('siswa1234')
            ],
            [
                'name'    => 'Rachel Diana Rahajuningtyas, S.Pd',
                'level' => 'guru',
                'email'    => 'racheldiana_guru@skpk.id',
                'remember_token' => Str::random(60),
                'password'    => bcrypt('racheldiana1234')
            ],
        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
