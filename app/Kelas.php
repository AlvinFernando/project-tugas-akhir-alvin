<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas','tahun_ajaran_id'];

    public function tahun_ajaran(){
    	return $this->belongsTo(TahunAjaran::class);
    }

    public function siswa(){
    	return $this->hasMany(Siswa::class);
    }

    public function mapel(){
    	return $this->hasMany(Mapel::class);
    }

    public function materi(){
    	return $this->hasMany(Materi::class);
    }

    public function tugas_siswa(){
    	return $this->hasMany(TugasSiswa::class);
    }

    public function agenda(){
    	return $this->hasMany(Agenda::class);
    }
}
