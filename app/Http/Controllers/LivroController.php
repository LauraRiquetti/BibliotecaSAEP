<?php


namespace App\Http\Controllers;


use App\Models\Livro;
use Illuminate\Http\Request;


class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::orderBy('created_at', 'desc')->get();
        return view('livros.index', compact('livros'));
    }


    public function create()
    {
        return view('livros.create');
    }


    public function store(Request $request)
    {
        // Validação alinhada com o seu formulário HTML
        $dadosValidados = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:0|max:' . date('Y'),
            'genero' => 'nullable|string|max:255',
            'quantidade_paginas' => 'nullable|integer|min:1',
            'status' => 'required|string'
        ]);

        // Cria o registro usando os dados validados
        Livro::create($dadosValidados);

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso.');
    }

// Correção do Destroy para funcionar perfeitamente com a rota Resource
    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro deletado com sucesso.');
    }


    // 1. Esta função ABRE a página (GET)
    public function edit($id)
    {
        $livro = Livro::findOrFail($id); // Remova o 's' aqui
        return view('livros.edit', compact('livro')); // Agora o nome bate!
    }
    
    // 2. Esta função SALVA os dados (PUT)
    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);
        $livro->update($request->all());

        return redirect()->route('livros.index')->with('success', 'Atualizado!');
    }


    /**
     * Remove the specified resource from storage.
     */
    
}