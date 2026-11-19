{{-- $pessoa é null ao criar e o objeto Pessoa ao editar --}}
<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" id="nome" name="nome"
        value="{{ old('nome', $pessoa?->nome) }}"
        class="form-control @error('nome') is-invalid @enderror" required autofocus>
    @error('nome')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        {{-- Ao editar, mostra a foto atual --}}
        @if ($pessoa?->foto)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $pessoa->foto) }}" alt="Foto atual"
                class="rounded" style="max-height: 120px">
        </div>
        @endif
        <input type="file" id="foto" name="foto" accept="image/*"
            class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">
            JPG, PNG ou WebP, até 2 MB.
            @if ($pessoa) Deixe em branco para manter a foto atual. @endif
        </div>
    </div>