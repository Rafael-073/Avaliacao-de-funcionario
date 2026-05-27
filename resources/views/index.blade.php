@extends('layout')

@section('conteudo')

<h1> Funcionários </h1>

{{-- Erros de validação --}}
@if ($errors->any())
    <ul>>
        @foreach ($errors->all() as $erro)
            <li> {{ $erro }} </li>
        @endforeach
    </ul>
@endif

{{--Listagem de funcionários--}}
@if (count($funcionarios) ==0)
    <p> Nenhum funcionário cadastrado. </p>
@else
    <table>
        <tr>
            <th> Empresa </th>
            <th> Nome </th>
            <th> Cargo </th>
        </tr>
        @foreach ($funcionarios as $func)
            <tr>
                <td> {{ $func->empresa }} </td>
                <td> {{ $func->nome }} </td>
                <td> {{ $func->cargo }} </td>
                <td>

                  <a href="/funcionarios/visualizar/{{ $func->id }}">Visualizar</a> |
                <a href="/funcionarios/editar/{{ $func->id }}">Editar</a> |
                <a href="/avaliacoes/criar/{{ $func->id }}">Avaliar</a> |
                <form action="{{ route('funcionarios.apagar', $funcionario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Excluir
                    </button>
                </form>
                </td>
            </tr>
        @endforeach
        {{ $funcionarios->links() }}
    </table>
@endif

<br><hr>

{{--Formulario de cadastro na parte de baixo da mesma tela--}}
<h2> Cadastrar novo funcionário </h2>

<form action="/funcionarios/salvar" method="POST">
    @call_user_func

    <label> Empresa: </label><br>
    <input type="text"name="empresa"><br><br>

    <label>Nome: </label><br>
    <input type="text"name="nome"><br><br>

    <label>Cargo: </label><br>
    <input type="text"name="cargo"><br><br>

    <input type="submit" value="Cadastrar">
</form>

@endsection