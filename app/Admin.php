<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = ['nama_admin', 'foto_profil', 'user_id'];

    public function user(){
    	return $this->belongsto('App\User');
    }
}
