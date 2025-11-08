<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

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
}
