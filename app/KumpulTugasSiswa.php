<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KumpulTugasSiswa extends Model
{
    //
    protected $table = 'kumpul_tugas_siswa';
    protected $fillable = ['tugas_siswas_id', 'nama_tugas', 'isi', 'users_id', 'file_tugas_siswa', 'status'];

    public function tugas_siswas() {
        return $this->belongsTo(TugasSiswa::class);
    }

    public function users(){
    	return $this->belongsto(User::class);
    }

    //File
    public function files(){
        return $this->hasMany(FileTugasSiswa::class);
    }
}
