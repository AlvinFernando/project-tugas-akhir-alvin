<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['no_induk','nama_siswa','kelas_id', 'guru_id',
                            'jk', 'agama', 'alamat', 'no_telp', 'foto_profil', 'user_id',
                            'nama_ayah', 'nama_ibu', 'nama_wali'];

    public function kelas(){
    	return $this->belongsTo(Kelas::class);
    }

    public function guru(){
    	return $this->belongsTo(Guru::class);
    }

    public function getProfile(){
        if(!$this->foto_profil){
            return asset('assets/img/default.jpg');
        } else{
            return asset('images/'.$this->foto_profil);
        }
    }

    public function user(){
    	return $this->belongsto(User::class);
    }

}
