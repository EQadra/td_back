<?php

namespace App\Http\Controllers\API;

use App\Models\Lawyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LawyerController extends Controller
{
    public function index()
    {
        return Lawyer::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'field' => 'required|string',
            'whatsapp_link' => 'nullable|url',
            'bar_number' => 'required|string|unique:lawyers,bar_number',
        ]);

        $lawyer = Lawyer::create($data);
        return response()->json($lawyer, 201);
    }

    public function show(Lawyer $lawyer)
    {
        return $lawyer->load('user');
    }

    public function update(Request $request, Lawyer $lawyer)
    {
        $data = $request->validate([
            'field' => 'nullable|string',
            'whatsapp_link' => 'nullable|url',
            'bar_number' => 'nullable|string|unique:lawyers,bar_number,' . $lawyer->id,
        ]);

        $lawyer->update($data);
        return response()->json($lawyer);
    }

    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();
        return response()->noContent();
    }
}
