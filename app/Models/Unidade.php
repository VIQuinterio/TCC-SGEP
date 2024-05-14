<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $table = 'unidade';

    protected $fillable = [
        'nm_unidade',
        'ds_endereco',
        'id_usuario',
    ];

    public function modalidades()
    {
        return $this->belongsToMany(Modalidade::class, 'unidade_modalidade', 'id_unidade', 'id_modalidade', null, 'id_modalidade');
    }
}
