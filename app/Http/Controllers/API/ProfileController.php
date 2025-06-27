<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'avatar' => 'nullable|string',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        $profile = Profile::create($data);
        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        return $profile;
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'avatar' => 'nullable|string',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        $profile->update($data);
        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->noContent();
    }
}
