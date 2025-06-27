<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        return Comment::latest()->take(5)->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string'
        ]);
        return Comment::create($data);
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return response()->noContent();
    }
}