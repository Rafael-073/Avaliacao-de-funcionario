@extends('layout')

@section('conteudo')


<h1>{{ $funcionario->empresa }}</h1>
<h1>{{ $funcionario->nome }}</h1>
<h1>{{ $funcionario->cargo }}</h1>

<a href="{{ route('avaliacoes.criar', $funcionario->id) }}">Nova Avaliação</a>

<br><br>

<h2>Avaliações</h2>

@if ($funcionario->avaliacoes->isEmpty())
    <p> Nenhuma avaliação cadastrada. </p>
@else
    @foreach ($funcionario->avaliacoes->sortByDesc('mes') as $avaliacao)
        <div>
 
            <h3>{{ \Carbon\Carbon::parse($avaliacao->mes . '-01')->format('F/Y') }}</h3>
 
            <table >
                <tr>
                    <th>Critério</th>
                    <th>Nota</th>
                    <th>Motivo</th>
                </tr>
                <tr>
                    <td>Trabalho em Equipe</td>
                    <td>{{ $avaliacao->trabalho_equipe }}</td>
                    <td>{{ $avaliacao->motivo_trabalho_equipe ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Comunicação</td>
                    <td>{{ $avaliacao->comunicacao }}</td>
                    <td>{{ $avaliacao->motivo_comunicacao ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Iniciativa</td>
                    <td>{{ $avaliacao->iniciativa }}</td>
                    <td>{{ $avaliacao->motivo_iniciativa ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Organização</td>
                    <td>{{ $avaliacao->organizacao }}</td>
                    <td>{{ $avaliacao->motivo_organizacao ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Produtividade</td>
                    <td>{{ $avaliacao->produtividade }}</td>
                    <td>{{ $avaliacao->motivo_produtividade ?? '—' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Média</strong></td>
                    <td><strong>{{ $avaliacao->media }}</strong></td>
                </tr>
            </table>
 
            @if ($avaliacao->observacao)
                <p><strong>Observação:</strong> {{ $avaliacao->observacao }}</p>
            @endif
 
        </div>
    @endforeach
@endif

<a href="/funcionarios">Voltar</a>

@endsection