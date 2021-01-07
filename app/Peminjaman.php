<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    public function gedung()
    {
        return $this->belongsTo('App\Gedung');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
