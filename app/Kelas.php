<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas','tahun_ajaran_id'];

    public function tahun_ajaran(){
    	return $this->belongsTo('App\TahunAjaran');
    }

    public function siswa(){
    	return $this->hasMany('App\Siswa');
    }

    public function mapel(){
    	return $this->hasMany('App\Mapel');
    }

    public function materi(){
    	return $this->hasMany('App\Materi');
    }
}
