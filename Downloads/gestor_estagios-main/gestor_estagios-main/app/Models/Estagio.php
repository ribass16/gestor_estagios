<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'empresa_id',
        'orientador_id',
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'estado',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class);
    }
}
