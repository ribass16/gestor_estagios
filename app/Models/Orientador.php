<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientador extends Model
{
    use HasFactory;

    protected $table = 'orientadores';

    protected $fillable = [
        'user_id',
        'departamento',
        'telemovel',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAprovado(): bool
    {
        return $this->estado === 'aprovado';
    }
    
    public function estagios()
    {
        return $this->hasMany(Estagio::class);
    }

}
