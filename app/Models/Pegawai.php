<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['n_pegawai', 'telp', 'alamat', 'user_id', 't_lahir', 'd_lahir', 'jk', 'pekerjaan', 'alamat'];
}
