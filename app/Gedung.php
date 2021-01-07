<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}
