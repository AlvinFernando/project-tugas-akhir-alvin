<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['judul', 'isi_pengumuman', 'users_id'];
    
    public function users(){
    	return $this->belongsto(User::class);
    }
}
