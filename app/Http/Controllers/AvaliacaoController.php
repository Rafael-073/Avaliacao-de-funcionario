<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    // Exibe o formulário de avaliação para um funcionário
    public function criar($funcionario_id)
    {
        $funcionario = Funcionario::find($funcionario_id);
        return view('avaliacoes.criar', ['funcionario' => $funcionario]);
    }

    // Salva a avaliação no banco
    public function salvar(Request $request, $funcionario_id)
    {
        $request->validate([
            'mes'                    => 'required',
            'trabalho_equipe'        => 'required|numeric|min:0|max:10',
            'comunicacao'            => 'required|numeric|min:0|max:10',
            'iniciativa'             => 'required|numeric|min:0|max:10',
            'organizacao'            => 'required|numeric|min:0|max:10',
            'produtividade'          => 'required|numeric|min:0|max:10',
        ]);

        // Verifica se já existe avaliação desse funcionário nesse mês
        $jaAvaliado = Avaliacao::where('funcionario_id', $funcionario_id)
                               ->where('mes', $request->mes)
                               ->first();

        if ($jaAvaliado) {
            // Volta com mensagem de erro sem salvar
            return back()->withErrors(['mes' => 'Este funcionário já foi avaliado neste mês.']);
        }

        // Calcula a média das 5 notas
        $media = (
            $request->trabalho_equipe +
            $request->comunicacao +
            $request->iniciativa +
            $request->organizacao +
            $request->produtividade
        ) / 5;

        Avaliacao::create([
            'funcionario_id'         => $funcionario_id,
            'mes'                    => $request->mes,
            'trabalho_equipe'        => $request->trabalho_equipe,
            'motivo_trabalho_equipe' => $request->motivo_trabalho_equipe,
            'comunicacao'            => $request->comunicacao,
            'motivo_comunicacao'     => $request->motivo_comunicacao,
            'iniciativa'             => $request->iniciativa,
            'motivo_iniciativa'      => $request->motivo_iniciativa,
            'organizacao'            => $request->organizacao,
            'motivo_organizacao'     => $request->motivo_organizacao,
            'produtividade'          => $request->produtividade,
            'motivo_produtividade'   => $request->motivo_produtividade,
            'media'                  => round($media, 2),
            'observacao'             => $request->observacao,
        ]);

        return redirect('/funcionarios');
    }
}