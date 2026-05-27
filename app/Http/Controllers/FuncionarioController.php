<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function listar()
    {
        $funcionarios = Funcionario::paginate(10);

        return view('funcionarios.index', compact('funcionarios'));
    }

    public function criar()
    {
        return view('funcionarios.criar');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
        ]);

        Funcionario::create([
            'nome' => $request->nome,
            'cargo' => $request->cargo,
            'empresa' => $request->empresa,
        ]);

        return redirect()
            ->route('funcionarios.listar')
            ->with('success', 'Funcionário cadastrado com sucesso.');
    }

    public function editar($id)
    {
        $funcionario = Funcionario::findOrFail($id);

        return view('funcionarios.editar', compact('funcionario'));
    }

    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
        ]);

        $funcionario = Funcionario::findOrFail($id);

        $funcionario->update([
            'nome' => $request->nome,
            'cargo' => $request->cargo,
            'empresa' => $request->empresa,
        ]);

        return redirect()
            ->route('funcionarios.listar')
            ->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function apagar($id)
}