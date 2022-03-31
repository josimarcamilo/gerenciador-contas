@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container">
    <button id="btn-criar-editar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-criar-editar">
        Adicionar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modal-criar-editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <form id="form-cria-edita" method="post" action="{{ route('contas.criarEditar') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Descrição</label>
                            <input name="descricao" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select" aria-label="Default select example">
                                <option value="1">A pagar</option>
                                <option value="2">A receber</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valor</label>
                            <input name="valor" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vencimento</label>
                            <input name="vencimento" type="date" class="form-control">
                        </div>
                        <input name="acao" value="criar" class="form-control" type="hidden">
                        <input name="codigo" value="" class="form-control" type="hidden">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br>
    <br>
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

    {{-- list contas --}}
    <br>
    <br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($contas as $conta)
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td>{{ $conta->descricao }}</td>
                        <td>{{ \App\Models\Conta::TYPE_DESCRIPTION[$conta->tipo] }}</td>
                        <td>{{ \App\Models\Conta::STATUS_DESCRIPTION[$conta->status] }}</td>
                        <td>{{ $conta->valor /100 }}</td>
                        <td>{{ $conta->vencimento }}</td>
                        <td>
                            <div style="display:flex;">
                                @if($conta->status == 1)
                                    <button id="btn-quitar" data-id="{{$conta->id}}" type="button" class="btn btn-primary quitar" data-bs-toggle="modal" data-bs-target="#modal-quitar">
                                        Quitar
                                    </button>
                                @endif
                                <form id="form-deletar" method="post" action="{{ route('contas.editar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input name="conta" value="{{$conta}}" class="form-control" type="hidden" id="formFile">

                                    <button id="btn-editar" data-conta="{{$conta}}" type="button" class="btn btn-primary btn-editar">
                                        Editar
                                    </button>
                                </form>
                                <form id="form-deletar" method="post" action="{{ route('contas.deletar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input name="codigo_conta" value="{{$conta->id}}" class="form-control" type="hidden" id="formFile">

                                    <button id="btn-deletar" type="submit" class="btn btn-primary">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php
                        $counter += 1;
                    @endphp
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal-quitar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="form-quitar" method="post" action="{{ route('contas.quitar') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Adicionar comprovante</label>
                            <input name="comprovante" class="form-control" type="file" id="formFile">
                            <input name="codigo_conta" class="form-control" type="hidden" id="formFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
