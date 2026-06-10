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
        $request->validate([
            'nome' => 'required',
            'autor' => 'required',
            'editora' => 'required',
            'ano' => 'required',
            'categoria' => 'required',
            'quantidade' => 'required',
        ]);


        Livro::create($request->all());


        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso.');
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
    public function destroy(Livro $livro)
    {
        $livro->delete();


        return redirect()->route('livros.index')->with('success', 'Livro deletado com sucesso.');
    }
}