<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaga_id',
        'aluno_id',
        'estado',
    ];

    public function vaga()
    {
        return $this->belongsTo(\App\Models\Vaga::class, 'vaga_id');
    }
    public function aluno()
    {
        return $this->belongsTo(\App\Models\Aluno::class, 'aluno_id');
    }



    public function orientador()
    {
        return $this->belongsTo(User::class, 'orientador_id');
    }

     public function estagio()
    {
        return $this->hasOne(Estagio::class);
    }
}
