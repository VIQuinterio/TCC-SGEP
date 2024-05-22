<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    use HasFactory;
    protected $table = 'modalidade';

    protected $fillable = [
        'nm_modalidade',
        'ds_modalidade',
        'id_usuario',
    ];

    public function unidades()
    {
        return $this->belongsToMany(
            Unidade::class, 
            'unidade_modalidade', 
            'id_modalidade', 
            'id_unidade', 
            'id_modalidade', 
            'id_unidade'
        )->withPivot('ds_horario');
    }
}
