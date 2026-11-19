@extends('layouts.app')
@section('titulo', 'Pessoas')
@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Pessoas</h1>
    {{-- Só o admin enxerga o botão (a proteção real está na rota) --}}
    @can('admin')
    <a href="{{ route('pessoas.create') }}" class="btn btn-primary">Adicionar pessoa</a>
    @endcan
</div>
<table class="table table-striped table-hover align-middle bg-white">
    <thead>
        <tr>
            <th style="width: 80px">Foto</th>
            <th>Nome</th>
            @can('admin')
            <th class="text-end">Ações</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @forelse ($pessoas as $pessoa)
        <tr>
            <td>
                @if ($pessoa->foto)
                <img src="{{ asset('storage/' . $pessoa->foto) }}" alt="Foto de {{ $pessoa->nome }}"
                    class="rounded-circle" width="48" height="48" style="object-fit: cover">
                @else
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center
justify-content-center" style="width: 48px; height: 48px">
                    {{ mb_strtoupper(mb_substr($pessoa->nome, 0, 1)) }}
                </div>
                @endif
            </td>
            <td>{{ $pessoa->nome }}</td>
            @can('admin')
            <td class="text-end">
                <a href="{{ route('pessoas.edit', $pessoa) }}"
                    class="btn btn-sm btn-outline-primary">Editar</a>
                {{-- Excluir precisa de DELETE, então é um formulário --}}
                <form method="POST" action="{{ route('pessoas.destroy', $pessoa) }}"

                    class="d-inline"
                    onsubmit="return confirm('Excluir esta pessoa?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
            @endcan
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center text-muted py-4">Nenhuma pessoa cadastrada.</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{-- Links de paginação (estilizados pelo Paginator::useBootstrapFive) --}}
{{ $pessoas->links() }}
@endsection