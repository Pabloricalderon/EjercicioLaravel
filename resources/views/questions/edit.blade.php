<x-forum.layouts.app>
    <h1 class="text-2xl font-bold mb-4">Editar pregunta</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold">Título</label>
            <input name="title" value="{{ old('title', $question->title) }}"
                   class="w-full rounded-md p-2 text-sm border" required />
        </div>

        <div>
            <label class="block text-sm font-semibold">Categoría</label>
            <select name="category_id" class="w-full rounded-md p-2 text-sm border" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $question->category_id) == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold">Contenido</label>
            <textarea name="content" rows="8" class="w-full rounded-md p-2 text-sm border" required>
{{ old('content', $question->content) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button class="rounded-md bg-blue-600 hover:bg-blue-500 px-4 py-2 text-white">Guardar cambios</button>
            <a href="{{ route('question.show', $question) }}" class="px-4 py-2 text-sm hover:underline">Cancelar</a>
        </div>
    </form>
</x-forum.layouts.app>
