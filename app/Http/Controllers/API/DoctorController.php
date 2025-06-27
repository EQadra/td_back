<?php

namespace App\Http\Controllers\API;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        return Doctor::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialization' => 'required|string',
            'license_number' => 'required|string|unique:doctors,license_number',
        ]);

        $doctor = Doctor::create($data);
        return response()->json($doctor, 201);
    }

    public function show(Doctor $doctor)
    {
        return $doctor->load('user');
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'specialization' => 'nullable|string',
            'license_number' => 'nullable|string|unique:doctors,license_number,' . $doctor->id,
        ]);

        $doctor->update($data);
        return response()->json($doctor);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->noContent();
    }
}
