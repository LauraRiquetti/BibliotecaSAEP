<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Usuario; // Certifique-se que seu model se chama Usuario (ou mude para User)
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmprestimoController extends Controller
{
    /**
     * Lista todos os empréstimos.
     */
    public function index()
    {
        // Usamos o 'with' para carregar os dados do livro e usuário de uma vez (Eager Loading)
        // Isso evita erros de "property of non-object" na sua View index.
        $emprestimos = Emprestimo::with(['livro', 'usuario'])->get();

        return view('emprestimos.index', compact('emprestimos'));
    }

    /**
     * Mostra o formulário de novo empréstimo.
     */
    public function create()
    {
        // Só permite emprestar livros que estejam com status 'disponível'
        $livros = Livro::where('status', 'disponível')->where('quantidade', '>', 0)->get();
        $usuarios = Usuario::all();

        return view('emprestimos.create', compact('livros', 'usuarios'));
    }

    /**
     * Salva o empréstimo e atualiza o status do livro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'usuario_id' => 'required|exists:users,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'required|date|after:data_emprestimo',
        ], [
            'data_devolucao.after' => 'A data de devolução deve ser posterior à data de empréstimo.'
        ]);

        // 1. Cria o registro do empréstimo
        Emprestimo::create([
            'livro_id' => $request->livro_id,
            'user_id'    => $request->usuario_id,
            'data_emprestimo' => $request->data_emprestimo,
            'data_devolucao' => $request->data_devolucao,
            'status' => 'emprestado'
        ]);

        // 2. Atualiza o status do livro para 'indisponível'
        $livro = Livro::find($request->livro_id);
        $livro->update(['status' => 'indisponível']);

        return redirect()->route('emprestimos.index')
                         ->with('success', 'Empréstimo registrado e status do livro atualizado!');
    }

    /**
     * Mostra o formulário de edição (ex: para renovar data).
     */
    public function edit(Emprestimo $emprestimo)
    {
        $livros = Livro::all();
        $usuarios = Usuario::all();
        return view('emprestimos.edit', compact('emprestimo', 'livros', 'usuarios'));
    }

    /**
     * Atualiza o empréstimo (ex: marcar como devolvido).
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $request->validate([
            'status' => 'required|in:emprestado,devolvido',
        ]);

        $emprestimo->update($request->all());

        // Se o status mudar para devolvido, voltamos o livro para 'disponível'
        if ($request->status == 'devolvido') {
            $emprestimo->livro->update(['status' => 'disponível']);
        }

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo atualizado!');
    }

    /**
     * Remove o registro de empréstimo.
     */
    public function destroy(Emprestimo $emprestimo)
    {
        // Antes de deletar, garantir que o livro volte a ficar disponível
        $emprestimo->livro->update(['status' => 'disponível']);
        
        $emprestimo->delete();

        return redirect()->route('emprestimos.index')->with('success', 'Registro excluído.');
    }

    public function livro() {
        return $this->belongsTo(Livro::class);
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }
}