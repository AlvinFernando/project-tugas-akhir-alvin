<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = 'agenda';
    protected $fillable = ['judul', 'isi_agenda', 'user_id'];

    public function users(){
    	return $this->belongsto('App\User');
    }
}
