@extends('layout')

@section('title', 'Clientes')

@section('content')
<div class="container">
    <br>
    <br>
    <div>
        @if(count($contasPendentes))
            <div class="row">
                @foreach ($totais as $description => $total)
                    <div class="col-sm-6">
                        <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $description }}</h5>
                            <p class="card-text">{{ $total }}</p>
                        </div>
                        </div>
                    </div>            
                @endforeach
            </div>
            <br>
            <br>
            <h5>Contas pendentes</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Pagamento</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($contasPendentes as $conta)
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td>{{ $conta->descricao }}</td>
                            <td>{{ \App\Models\Conta::STATUS_DESCRIPTION[$conta->status] }}</td>
                            <td>{{ $conta->valor /100 }}</td>
                            
                        </tr>
                        @php
                            $counter += 1;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        @else
            <h5>Você está em dias com suas contas!</h5>
        @endif

        <br>
        <br>
        <h5>Histórico</h5>
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Pagamento</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($contasQuitadas as $conta)
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td>{{ $conta->descricao }}</td>
                            <td>{{ \App\Models\Conta::STATUS_DESCRIPTION[$conta->status] }}</td>
                            <td>{{ $conta->valor /100 }}</td>
                            
                        </tr>
                        @php
                            $counter += 1;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        
    </div>
</div>
@endsection
