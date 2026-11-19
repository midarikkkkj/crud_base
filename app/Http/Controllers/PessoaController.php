<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Storage;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::orderBy('nome')->paginate(10);
        return view('pessoas.index', compact('pessoas'));
    }
    public function create()
    {
        return view('pessoas.create');
    }
    public function store(PessoaRequest $request)
    {
        $dados = $request->safe()->only(['nome']);
        // Se enviaram foto, salva em storage/app/public/fotos e guarda o caminho
        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }
        Pessoa::create($dados);
        return redirect()->route('pessoas.index')
            ->with('sucesso', 'Pessoa cadastrada com sucesso!');
    }
    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }
    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $dados = $request->safe()->only(['nome']);
        if ($request->hasFile('foto')) {
            // Apaga a foto antiga para não acumular arquivos órfãos
            if ($pessoa->foto) {
                Storage::disk('public')->delete($pessoa->foto);
            }
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }
        $pessoa->update($dados);
        return redirect()->route('pessoas.index')
            ->with('sucesso', 'Pessoa atualizada com sucesso!');
    }
    public function destroy(Pessoa $pessoa)
    {
        // Remove o arquivo da foto antes de apagar o registro
        if ($pessoa->foto) {
            Storage::disk('public')->delete($pessoa->foto);
        }
        $pessoa->delete();
        return redirect()->route('pessoas.index')
            ->with('sucesso', 'Pessoa excluída com sucesso!');
    }
}
