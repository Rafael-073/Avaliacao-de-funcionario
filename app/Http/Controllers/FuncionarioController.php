<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    // Lista todos os funcionários na tela inicial
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('index', ['funcionarios' => $funcionarios]);
    }

    // Salva um novo funcionário (formulário está na própria tela index)
    public function salvar(Request $request)
    {
        $request->validate([
            'empresa' => $request->empresa,
            'nome'  => 'required|string',
            'cargo' => 'required|string',
            
        ]);

        Funcionario::create([
            'empresa' => $request->empresa,
            'nome'  => $request->nome,
            'cargo' => $request->cargo,
        ]);

        return redirect('/funcionarios');
    }

    // Exibe o formulário de edição
    public function editar($id)
    {
        $funcionario = Funcionario::find($id);
        return view('funcionarios.editar', ['funcionario' => $funcionario]);
    }

    // Salva as alterações do funcionário
    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'empresa' => $request->empresa,
            'nome'  => 'required|string',
            'cargo' => 'required|string',
        ]);

        $funcionario = Funcionario::find($id);
        $funcionario->nome  = $request->nome;
        $funcionario->cargo = $request->cargo;
        $funcionario->save();

        return redirect('/funcionarios');
    }

    // Visualiza o funcionário e suas avaliações
    public function visualizar($id)
    {
        // Aqui está o JOIN que você mencionou.
        // Em vez de SQL puro, o Laravel faz o join por meio do relacionamento.
        // O with('avaliacoes') já faz internamente:
        // SELECT * FROM avaliacoes WHERE funcionario_id = $id
        // e junta com os dados do funcionário — equivale a um INNER JOIN.
        $funcionario = Funcionario::with('avaliacoes')->find($id);

        return view('funcionarios.visualizar', ['funcionario' => $funcionario]);
    }

    // Apaga o funcionário (as avaliações são apagadas junto pelo cascadeOnDelete)
    public function apagar($id)
    {
        $funcionario = Funcionario::find($id);
        $funcionario->delete();

        return redirect('/funcionarios');
    }
}
