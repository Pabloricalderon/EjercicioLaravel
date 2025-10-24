<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function show(Question $question){

        $question->load('answers','category','user');

        return view('questions.show',[
            'question' => $question,
        ]);
    }

   public function edit(Question $question)
{
    $this->authorize('update', $question); // solo dueño

    $categories = Category::orderBy('name')->get();
    return view('questions.edit', compact('question', 'categories'));
}

public function update(Request $request, Question $question)
{
    $this->authorize('update', $question); // solo dueño

    $data = $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required|string|max:5000',
        'category_id' => 'required|exists:categories,id',
    ]);

    $question->update($data);

    return redirect()
        ->route('question.show', $question)
        ->with('status', '¡Pregunta actualizada correctamente!');
}

public function destroy(Question $question)
{
    $this->authorize('delete', $question); // solo dueño
    $question->delete();

    return redirect()->route('home')->with('status', 'Pregunta eliminada.');
}

    // Muestra el formulario
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('questions.create', compact('categories'));
    }

    // Guarda la pregunta y redirige al detalle
    public function store(Request $request)
    {
        // Valida según tu esquema de BD (ajusta si tus columnas difieren)
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string|max:5000',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Asocia al usuario logueado
        $data['user_id'] = Auth::id();

        $question = Question::create($data);

        return redirect()
            ->route('question.show', $question) // Asumiendo ruta existente: /question/{question}
            ->with('status', '¡Pregunta creada con éxito!');
    }
}

