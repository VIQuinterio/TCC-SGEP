<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    use HasFactory;
    protected $table = 'modalidade';
    protected $primaryKey = 'id_modalidade';

    protected $fillable = [
        'nm_modalidade',
        'ds_modalidade',
        'id_usuario',
    ];
}
