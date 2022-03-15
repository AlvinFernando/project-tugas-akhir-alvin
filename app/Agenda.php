<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = 'agenda';
    protected $fillable = ['judul', 'isi_agenda', 'users_id', 'kelas_id'];

    public function users(){
    	return $this->belongsto(User::class);
    }

    public function kelas(){
    	return $this->belongsto(Kelas::class);
    }
}
