<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = ['judul_materi','mapel_id', 'isi_materi', 'file_materi', 'kelas_id', 'users_id'];

    public function kelas(){
    	return $this->belongsTo('App\Kelas');
    }

    public function mapel(){
    	return $this->belongsTo('App\Mapel');
    }

    public function users(){
    	return $this->belongsto('App\User');
    }

    public function files(){
        return $this->hasMany(FileUpload::class);
    }
}
