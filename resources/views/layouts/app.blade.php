<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Sistema de Livros</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('livros.index') }}" class="text-xl font-bold tracking-wide">📚 Bibliotech</a>
            <a href="{{ route('livros.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
                + Novo Livro
            </a>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 text-sm mt-auto">
        &copy; {{ date('Y') }} - Sistema de Cadastro de Livros
    </footer>

</body>
</html>
