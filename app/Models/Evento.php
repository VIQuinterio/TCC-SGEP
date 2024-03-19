<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';

    protected $fillable = [
        'nm_evento',
        'ds_evento',
        'dt_evento',
        'id_unidade',
        'id_usuario',
    ];				
}
