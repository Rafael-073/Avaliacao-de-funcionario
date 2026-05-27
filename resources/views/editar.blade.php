@extends('layout')

@section('conteudo')

<h1>Editar Funcionarios</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $erro)
            <li> {{ $erro }} </li>
        @endforeach
    </ul>
@endif

<form action="{{ route('funcionarios.atualizar', $funcionario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Empresa:</label><br>
    <input type="text" name="empresa" value="{{ $funcionario->empresa }}"> <br><br>

    <label>Nome:</label><br>
    <input type="text" name="nome" value="{{ $funcionario->nome }}"> <br><br>
    
    <label>Cargo:</label><br>
    <input type="text" name="cargo" value="{{ $funcionario->cargo }}"> <br><br>

    <button type="submit">Salvar alterações</button>
    <a href="/funcionarios">Cabcelar</a>
</form>

@endsection