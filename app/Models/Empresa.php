<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'nif',
        'email_contacto',
        'telemovel',
        'morada',
        'website',
        'setor',
        'descricao',
        'aceita_estagios',
        'estado',

        // novos campos do responsável
        'responsavel_nome',
        'responsavel_email',
        'responsavel_telemovel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vagas()
    {
        return $this->hasMany(Vaga::class, 'empresa_id');
    }

    public function isAprovada(): bool
    {
        return $this->estado === 'aprovada';
    }
}
