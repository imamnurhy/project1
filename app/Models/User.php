<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';
    protected $fillable = ['username', 'password', 'lastlogin', 'status'];
    protected $hidden = ['password', 'remember_token'];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }
}
