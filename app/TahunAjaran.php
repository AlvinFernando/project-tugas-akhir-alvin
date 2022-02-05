<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $fillable = ['thn_ajaran'];

    public function kelas(){
    	return $this->hasMany('App\Kelas');
    }
}
