<?php

namespace App\Http\Controllers\API;

use App\Models\Association;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssociationController extends Controller
{
    public function index()
    {
        return Association::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'sector' => 'nullable|string',
            'logo' => 'nullable|string',
        ]);

        $association = Association::create($data);
        return response()->json($association, 201);
    }

    public function show(Association $association)
    {
        return $association->load('user');
    }

    public function update(Request $request, Association $association)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'sector' => 'nullable|string',
            'logo' => 'nullable|string',
        ]);

        $association->update($data);
        return response()->json($association);
    }

    public function destroy(Association $association)
    {
        $association->delete();
        return response()->noContent();
    }
}
