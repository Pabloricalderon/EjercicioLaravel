<x-forum.layouts.app>
    <h1 class="text-2xl font-bold mb-4">Hacer una pregunta</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold">Título</label>
            <input
                name="title"
                value="{{ old('title') }}"
                required
                class="w-full rounded-md p-2 text-sm border"
                placeholder="Escribe un título claro y específico"
            />
        </div>

        <div>
            <label class="block text-sm font-semibold">Categoría</label>
            <select
                name="category_id"
                required
                class="w-full rounded-md p-2 text-sm border"
            >
                <option value="">— Selecciona —</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold">Contenido</label>
            <textarea
                name="content"
                rows="8"
                required
                class="w-full rounded-md p-2 text-sm border"
                placeholder="Describe en detalle tu problema o duda. Incluye lo que ya intentaste."
            >{{ old('content') }}</textarea>
        </div>

        <button class="rounded-md bg-blue-600 hover:bg-blue-500 px-4 py-2 text-white">
            Publicar
        </button>
    </form>
</x-forum.layouts.app>
