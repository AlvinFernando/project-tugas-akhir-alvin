<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepalaSekolah extends Model
{
    protected $table = 'kepala_sekolah';
    protected $fillable = ['nama_kepsek', 'jk', 'agama', 'alamat', 'no_telp', 'foto_profil', 'user_id'];

    public function user(){
    	return $this->belongsto('App\User');
    }

    public function getProfile(){
        if(!$this->foto_profil){
            return asset('assets/img/default.jpg');
        }

        return asset('images/'.$this->foto_profil);
    }
}
