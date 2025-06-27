<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rateable_type' => 'required|string|in:product,lawyer,doctor,store,association',
            'rateable_id' => 'required|integer',
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $models = [
            'product' => \App\Models\Product::class,
            'lawyer' => \App\Models\Lawyer::class,
            'doctor' => \App\Models\Doctor::class,
            'store' => \App\Models\Store::class,
            'association' => \App\Models\Association::class,
        ];

        $modelClass = $models[$request->rateable_type];
        $rateable = $modelClass::findOrFail($request->rateable_id);

        // Verificar si ya existe una calificación
        $existingRating = Rating::where([
            'user_id' => Auth::id(),
            'rateable_id' => $request->rateable_id,
            'rateable_type' => $modelClass,
        ])->first();

        if ($existingRating) {
            return response()->json(['message' => 'Ya calificaste este recurso.'], 422);
        }

        $rating = $rateable->ratings()->create([
            'user_id' => Auth::id(),
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Rating guardado exitosamente.',
            'data' => $rating,
        ]);
    }
}
