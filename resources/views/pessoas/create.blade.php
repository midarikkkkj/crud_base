@extends('layouts.app')
@section('titulo', 'Nova pessoa')
@section('conteudo')
<h1 class="h3 mb-3">Nova pessoa</h1>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('pessoas.store') }}" enctype="multipart/form-data">
            @csrf
            @include('pessoas._campos', ['pessoa' => null])
            <a href="{{ route('pessoas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection