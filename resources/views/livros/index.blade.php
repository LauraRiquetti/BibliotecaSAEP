@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-700 border-b pb-2">Livros Cadastrados</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Título</th>
                    <th class="py-3 px-6">Autor</th>
                    <th class="py-3 px-6">Ano</th>
                    <th class="py-3 px-6">Gênero</th>
                    <th class="py-3 px-6">Páginas</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($livros as $livro)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 font-medium text-gray-900">{{ $livro->titulo }}</td>
                        <td class="py-3 px-6">{{ $livro->autor }}</td>
                        <td class="py-3 px-6">{{ $livro->ano_publicacao }}</td>
                        <td class="py-3 px-6">{{ $livro->genero ?? '-' }}</td>
                        <td class="py-3 px-6">{{ $livro->quantidade_paginas ?? '-' }}</td>
                        <td class="py-3 px-6">
                            @if($livro->status == 'Disponível')
                                <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs font-semibold">Disponível</span>
                            @elseif($livro->status == 'Emprestado')
                                <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs font-semibold">Emprestado</span>
                            @else
                                <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs font-semibold">Reservado</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <a href="{{ route('livros.show', $livro->id) }}" class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200 text-xs font-bold">Ver</a>
                                <a href="{{ route('livros.edit', $livro->id) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded hover:bg-yellow-200 text-xs font-bold">Editar</a>
                                
                                <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-600 p-2 rounded hover:bg-red-200 text-xs font-bold cursor-pointer">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-500">Nenhum livro cadastrado ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
