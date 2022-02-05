<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama_mapel','kelas_id', 'guru_id'];

    public function kelas(){
    	return $this->belongsTo('App\Kelas');
    }

    public function guru(){
    	return $this->belongsTo('App\Guru');
    }

    public function materi(){
    	return $this->hasMany('App\Materi');
    }
}
