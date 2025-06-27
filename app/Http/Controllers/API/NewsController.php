<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;

class NewsController extends Controller
{
    /**
     * Mostrar todas las noticias.
     */
    public function index()
    {
        return response()->json(News::with('user')->get());
    }

    /**
     * Filtrar noticias por rol de usuario (doctor, abogado, asociacion, tienda).
     */
    public function byRole($role)
    {
        $news = News::whereHas('user', function ($query) use ($role) {
            $query->where('role', $role);
        })->with('user')->get();

        return response()->json($news);
    }

    /**
     * Guardar una nueva noticia (el usuario autenticado debe estar asociado).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $news = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return response()->json($news, 201);
    }

    /**
     * Mostrar una noticia específica.
     */
    public function show(string $id)
    {
        $news = News::with('user')->findOrFail($id);
        return response()->json($news);
    }

    /**
     * Actualizar una noticia existente.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        if ($news->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $news->update($request->only(['title', 'content']));

        return response()->json($news);
    }

    /**
     * Eliminar una noticia.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $news->delete();

        return response()->json(['message' => 'Noticia eliminada']);
    }
}