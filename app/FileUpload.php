<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $guarded = [];

    public function materi() {
        return $this->belongsTo(Materi::class);
    }
}
