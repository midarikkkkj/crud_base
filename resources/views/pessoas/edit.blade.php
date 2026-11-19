@extends('layouts.app')
@section('titulo', 'Editar pessoa')
@section('conteudo')
<h1 class="h3 mb-3">Editar pessoa</h1>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('pessoas.update', $pessoa) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- o HTML só envia POST; isto vira PUT --}}
            @include('pessoas._campos')
            <a href="{{ route('pessoas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</div>
@endsection