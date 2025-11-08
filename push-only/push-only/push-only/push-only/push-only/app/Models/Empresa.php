<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'nif',
        'telemovel',
        'email_contacto',
        'morada',
        'website',
        'setor',
        'descricao',
        'aceita_estagios',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
