<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama_mapel','kelas_id', 'guru_id'];

    public function kelas(){
    	return $this->belongsTo(Kelas::class);
    }

    public function guru(){
    	return $this->belongsTo(Guru::class);
    }

    public function materi(){
    	return $this->hasMany(Materi::class);
    }

    public function tugas_siswa(){
    	return $this->hasMany(TugasSiswa::class);
    }
}
