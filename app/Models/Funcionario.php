<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = ["empresa", "nome", "cargo"];

    // Um funcionário pode ter muitas avaliações (uma por mês)
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}