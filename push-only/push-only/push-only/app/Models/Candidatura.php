<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'vaga_id',
        'orientador_id',
        'estado',
    ];

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }



    public function orientador()
    {
        return $this->belongsTo(User::class, 'orientador_id');
    }
}
