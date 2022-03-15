<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = ['judul_materi','mapel_id', 'isi_materi',
                        'file_materi', 'kelas_id', 'users_id'];

    public function kelas(){
    	return $this->belongsTo(Kelas::class);
    }

    public function mapel(){
    	return $this->belongsTo(Mapel::class);
    }

    public function users(){
    	return $this->belongsto(User::class);
    }

    //File
    public function files(){
        return $this->hasMany(FileUpload::class);
    }
}
