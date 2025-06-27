<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id'
        ]);
        return Like::firstOrCreate($data);
    }

    public function destroy(Like $like) {
        $like->delete();
        return response()->noContent();
    }
}
