<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function store(Request $request) {
        $data = $request->validate(['name' => 'required|string|unique:categories']);
        return Category::create($data);
    }

    public function show(Category $category) {
        return $category;
    }

    public function update(Request $request, Category $category) {
        $data = $request->validate(['name' => 'required|string|unique:categories,name,' . $category->id]);
        $category->update($data);
        return $category;
    }

    public function destroy(Category $category) {
        $category->delete();
        return response()->noContent();
    }
}