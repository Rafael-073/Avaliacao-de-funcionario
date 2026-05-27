<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'mes',
        'pontualidade',
        'produtividade',
        'comportamento',
        'media',
    ];

    protected $casts = [
        'pontualidade' => 'integer',
        'produtividade' => 'integer',
        'comportamento' => 'integer',
        'media' => 'float',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function calcularMedia()
    {
        return (
            $this->pontualidade +
            $this->produtividade +
            $this->comportamento
        ) / 3;
    }
}