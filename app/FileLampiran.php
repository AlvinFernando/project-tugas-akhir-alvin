<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileLampiran extends Model
{
    //
    protected $guarded = [];

    public function tugas_siswa() {
        return $this->belongsTo(TugasSiswa::class);
    }
}
