<nav class="mx-auto max-w-4xl py-3 flex items-center justify-between">
    <a href="{{ route('home') }}" class="text-lg font-bold">
        Foro de programación
    </a>

    <div class="flex items-center gap-3">
        @auth
            <span class="text-sm">
                Hola, <strong>{{ auth()->user()->name }}</strong>
            </span>

            <a href="{{ route('questions.create') }}"
               class="rounded-md bg-blue-600 hover:bg-blue-500 px-3 py-1 text-sm text-white">
                Preguntar
            </a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-sm text-gray-300 hover:underline">
                    Cerrar sesión
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm hover:underline">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="text-sm hover:underline">Registrarse</a>
        @endauth
    </div>
</nav>
