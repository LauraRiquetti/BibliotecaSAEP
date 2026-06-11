<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    // app/Models/Livro.php

    protected $fillable = [
        'nome', 
        'autor', 
        'ano', 
        'editora', 
        'categoria', 
        'quantidade', 
        'status' // Não esqueça de adicionar o status aqui também!
    ];
}