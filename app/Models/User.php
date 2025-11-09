<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // app/Models/User.php

    public function empresa()
    {
        return $this->hasOne(\App\Models\Empresa::class);
    }


    public function aluno()
    {
        return $this->hasOne(\App\Models\Aluno::class);
    }

    public function orientador()
    {
        return $this->hasOne(\App\Models\Orientador::class);
    }




}
