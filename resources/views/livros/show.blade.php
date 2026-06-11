@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Detalhes do Livro</h2>
        <a href="{{ route('livros.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Voltar para a lista</a>
    </div>

    <div class="space-y-4">
        <div>
            <span class="block text-xs font-bold text-gray-400 uppercase">Título</span>
            <p class="text-lg font-semibold text-gray-800">{{ $livro->titulo }}</p>
        </div>

        <div>
            <span class="block text-xs font-bold text-gray-400 uppercase">Autor</span>
            <p class="text-gray-700">{{ $livro->autor }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <span class="block text-xs font-bold text-gray-400 uppercase">Ano de Publicação</span>
                <p class="text-gray-700">{{ $livro->ano_publicacao }}</p>
            </div>
            <div>
                <span class="block text-xs font-bold text-gray-400 uppercase">Gênero</span>
                <p class="text-gray-700">{{ $livro->genero ?? 'Não informado' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <span class="block text-xs font-bold text-gray-400 uppercase">Quantidade de Páginas</span>
                <p class="text-gray-700">{{ $livro->quantidade_paginas ?? 'Não informado' }}</p>
            </div>
            <div>
                <span class="block text-xs font-bold text-gray-400 uppercase">Status</span>
                <p class="mt-1">
                    @if($livro->status == 'Disponível')
                        <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs font-semibold">Disponível</span>
                    @elseif($livro->status == 'Emprestado')
                        <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs font-semibold">Emprestado</span>
                    @else
                        <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs font-semibold">Reservado</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="mt-8 pt-4 border-t flex justify-end">
        <a href="{{ route('livros.edit', $livro->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 text-sm font-semibold">
            Editar Informações
        </a>
    </div>
</div>
@endsection

