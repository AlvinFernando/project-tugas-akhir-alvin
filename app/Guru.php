<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['kode_guru','nama_guru', 'jk', 'agama', 'alamat', 'no_telp', 'foto_profil', 'user_id'];

    public function mapel(){
    	return $this->hasMany('App\Mapel');
    }

    public function siswa(){
    	return $this->hasMany('App\Siswa');
    }

    public function getProfile(){
        if(!$this->foto_profil){
            return asset('assets/img/default.jpg');
        }
        
        return asset('images/'.$this->foto_profil);
    }

    public function user(){
    	return $this->belongsto('App\User');
    }
}
