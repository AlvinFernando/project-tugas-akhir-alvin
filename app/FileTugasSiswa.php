<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileTugasSiswa extends Model
{
    //
    protected $guarded = [];

    public function kumpul_tugas_siswa() {
        return $this->belongsTo(KumpulTugasSiswa::class);
    }
}
