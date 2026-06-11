@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Editar Livro</h2>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Título *</label>
            <input type="text" name="titulo" value="{{ old('titulo', $livro->titulo) }}" required class="w-full p-2 border rounded focus:outline-blue-500">
            @error('titulo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-1">Autor *</label>
            <input type="text" name="autor" value="{{ old('autor', $livro->autor) }}" required class="w-full p-2 border rounded focus:outline-blue-500">
            @error('autor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Ano de Publicação *</label>
                <input type="number" name="ano_publicacao" value="{{ old('ano_publicacao', $livro->ano_publicacao) }}" required class="w-full p-2 border rounded focus:outline-blue-500">
                @error('ano_publicacao') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Gênero</label>
                <input type="text" name="genero" value="{{ old('genero', $livro->genero) }}" class="w-full p-2 border rounded focus:outline-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Quantidade de Páginas</label>
                <input type="number" name="quantidade_paginas" value="{{ old('quantidade_paginas', $livro->quantidade_paginas) }}" class="w-full p-2 border rounded focus:outline-blue-500">
                @error('quantidade_paginas') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Status *</label>
                <select name="status" required class="w-full p-2 border rounded focus:outline-blue-500 bg-white">
                    <option value="Disponível" {{ old('status', $livro->status) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="Emprestado" {{ old('status', $livro->status) == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
                    <option value="Reservado" {{ old('status', $livro->status) == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('livros.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 cursor-pointer">Atualizar Livro</button>
        </div>
    </form>
</div>
@endsection
