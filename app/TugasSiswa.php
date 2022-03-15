<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TugasSiswa extends Model
{
    //
    protected $table = 'tugas_siswas';
    protected $fillable = ['judul', 'isi_tugas', 'kelas_id', 'users_id', 'mapel_id'];

    public function kelas(){
    	return $this->belongsTo(Kelas::class);
    }

    public function mapel(){
    	return $this->belongsTo(Mapel::class);
    }

    public function users(){
    	return $this->belongsto(User::class);
    }
}
