<?php


namespace App\Http\Controllers;


use App\Models\Usuario;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }


    public function create()
    {
        return view('usuarios.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6',
        ]);


        Usuario::create($request->all());


        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }


    // 1. Esta função ABRE a página (GET)
public function edit($id)
{
    $usuario = Usuario::findOrFail($id); // Busca o usuário pelo ID
    return view('usuarios.edit', compact('usuario'));
}

// 2. Esta função SALVA os dados (PUT)
public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->update($request->all());

    return redirect()->route('usuarios.index')->with('success', 'Atualizado!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();


        return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso.');
    }
}