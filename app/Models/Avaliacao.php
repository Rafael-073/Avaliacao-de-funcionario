<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'funcionario_id',
        'mes',
        'trabalho_equipe',
        'motivo_trabalho_equipe',
        'comunicacao',
        'motivo_comunicacao',
        'iniciativa',
        'motivo_iniciativa',
        'organizacao',
        'motivo_organizacao',
        'produtividade',
        'motivo_produtividade',
        'media',
        'observacao',
    ];

    // Cada avaliação pertence a um funcionário
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}