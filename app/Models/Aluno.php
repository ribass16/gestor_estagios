<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'user_id',
        'curso',
        'ano_letivo',
        'numero_estudante',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class);
    }
}


