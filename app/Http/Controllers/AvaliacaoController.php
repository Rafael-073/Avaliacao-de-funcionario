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

        return view('avaliacoes.criar', compact('funcionario'));
    }

    public function salvar(Request $request, $id)
    {
        $request->validate([
            'mes' => 'required|string|max:20',
            'pontualidade' => 'required|integer|min:0|max:10',
            'produtividade' => 'required|integer|min:0|max:10',
            'comportamento' => 'required|integer|min:0|max:10',
        ]);

        $funcionario = Funcionario::findOrFail($id);

        $jaAvaliado = Avaliacao::where('funcionario_id', $funcionario->id)
            ->where('mes', $request->mes)
            ->exists();

        if ($jaAvaliado) {
            return back()->with('error', 'Este funcionário já foi avaliado neste mês.');
        }

        $avaliacao = new Avaliacao();

        $avaliacao->funcionario_id = $funcionario->id;
        $avaliacao->mes = $request->mes;
        $avaliacao->pontualidade = $request->pontualidade;
        $avaliacao->produtividade = $request->produtividade;
        $avaliacao->comportamento = $request->comportamento;

        $avaliacao->media = $avaliacao->calcularMedia();

        $avaliacao->save();

        return redirect()
            ->route('funcionarios.visualizar', $funcionario->id)
            ->with('success', 'Avaliação cadastrada com sucesso.');
    }
}