<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    // Esta é a lista de campos que o Laravel tem permissão para salvar
    protected $fillable = [
        'livro_id',
        'user_id',        // <--- Verifique se está 'user_id' e não 'usuario_id'
        'data_emprestimo',
        'data_devolucao',
        'status',
    ];

    // Relacionamento com Livro
    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    // Relacionamento com Usuário (usando a coluna user_id)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}