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
}
