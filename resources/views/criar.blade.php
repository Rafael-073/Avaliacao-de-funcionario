@extends('layout')

@section('conteudo')

<h1>Avaliar: {{ $funcionario->nome }}</h1>
<p><strong>Cargo:</strong> {{ $funcionario->cargo }}</p>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $erro)
            <li>{{ $erro }}</li>
        @endforeach
    </ul>
@endif

<form action="/avaliacoes/salvar/{{ $funcionario->id }}" method="POST">
    @csrf

    <label>Mês de referência:</label><br>
    {{-- type="month" exibe um seletor de mês/ano no navegador, retorna no formato YYYY-MM --}}
    <input type="month" name="mes"><br><br>

    <table>
        <tr>
            <th>Critério</th>
            <th>Nota (0 a 10)</th>
            <th>Motivo</th>
        </tr>

        <tr>
            <td>Trabalho em Equipe</td>
            <td>
                <input type="number" name="trabalho_equipe" step="0.1" min="0" max="10" style="width:70px">
            </td>
            <td>
                <textarea name="motivo_trabalho_equipe" rows="2" cols="30"></textarea>
            </td>
        </tr>

        <tr>
            <td>Comunicação</td>
            <td>
                <input type="number" name="comunicacao" step="0.1" min="0" max="10" style="width:70px">
            </td>
            <td>
                <textarea name="motivo_comunicacao" rows="2" cols="30"></textarea>
            </td>
        </tr>

        <tr>
            <td>Iniciativa</td>
            <td>
                <input type="number" name="iniciativa" step="0.1" min="0" max="10" style="width:70px">
            </td>
            <td>
                <textarea name="motivo_iniciativa" rows="2" cols="30"></textarea>
            </td>
        </tr>

        <tr>
            <td>Organização</td>
            <td>
                <input type="number" name="organizacao" step="0.1" min="0" max="10" style="width:70px">
            </td>
            <td>
                <textarea name="motivo_organizacao" rows="2" cols="30"></textarea>
            </td>
        </tr>

        <tr>
            <td>Produtividade</td>
            <td>
                <input type="number" name="produtividade" step="0.1" min="0" max="10" style="width:70px">
            </td>
            <td>
                <textarea name="motivo_produtividade" rows="2" cols="30"></textarea>
            </td>
        </tr>

    </table>

    <br>

    <label>Observação geral:</label><br>
    <textarea name="observacao" rows="3" cols="60"></textarea><br><br>

    <button type="submit">Salvar avaliação</button>
    <a href="/funcionarios">Cancelar</a>

</form>

@endsection