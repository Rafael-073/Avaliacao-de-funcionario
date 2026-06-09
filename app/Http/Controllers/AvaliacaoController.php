<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{
    public function criar($id)
    {
        $funcionario = Funcionario::findOrFail($id);

        return view('avaliacoes.avaliar', compact('funcionario'));
    }

    public function salvar(Request $request, $id)
{
    $request->validate([
        'mes'             => 'required',
        'trabalho_equipe' => 'required|numeric|min:0|max:10',
        'comunicacao'     => 'required|numeric|min:0|max:10',
        'iniciativa'      => 'required|numeric|min:0|max:10',
        'organizacao'     => 'required|numeric|min:0|max:10',
        'produtividade'   => 'required|numeric|min:0|max:10',
    ]);

    $funcionario = Funcionario::findOrFail($id);

    $jaAvaliado = Avaliacao::where('funcionario_id', $funcionario->id)
        ->where('mes', $request->mes)
        ->exists();

    if ($jaAvaliado) {
        return back()->with('error', 'Este funcionário já foi avaliado neste mês.');
    }

    $media = (
        $request->trabalho_equipe +
        $request->comunicacao +
        $request->iniciativa +
        $request->organizacao +
        $request->produtividade
    ) / 5;

    $avaliacao = new Avaliacao();
    $avaliacao->funcionario_id         = $funcionario->id;
    $avaliacao->mes                    = $request->mes;
    $avaliacao->trabalho_equipe        = $request->trabalho_equipe;
    $avaliacao->motivo_trabalho_equipe = $request->motivo_trabalho_equipe;
    $avaliacao->comunicacao            = $request->comunicacao;
    $avaliacao->motivo_comunicacao     = $request->motivo_comunicacao;
    $avaliacao->iniciativa             = $request->iniciativa;
    $avaliacao->motivo_iniciativa      = $request->motivo_iniciativa;
    $avaliacao->organizacao            = $request->organizacao;
    $avaliacao->motivo_organizacao     = $request->motivo_organizacao;
    $avaliacao->produtividade          = $request->produtividade;
    $avaliacao->motivo_produtividade   = $request->motivo_produtividade;
    $avaliacao->media                  = round($media, 2);
    $avaliacao->observacao             = $request->observacao;
    $avaliacao->save();

    return redirect()
        ->route('funcionarios.visualizar', $funcionario->id)
        ->with('success', 'Avaliação cadastrada com sucesso!');
}
}