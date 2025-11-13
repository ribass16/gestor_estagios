<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
    'titulo',
    'descricao',
    'empresa_id',
    'estado',
    ];


    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class, 'vaga_id');
    }


    public function empresa()
    {
<<<<<<< HEAD
        return $this->belongsTo(Empresa::class);
    }


=======
        return $this->belongsTo(\App\Models\Empresa::class, 'empresa_id');
    }



>>>>>>> 770e62dadcdfec38f7fcfd8fe65a6fecf7035852
}
