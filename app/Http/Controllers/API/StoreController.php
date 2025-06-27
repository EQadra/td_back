<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        return Store::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_name' => 'required|string',
            'ruc' => 'required|string|unique:stores,ruc',
            'logo' => 'nullable|string',
        ]);

        $store = Store::create($data);
        return response()->json($store, 201);
    }

    public function show(Store $store)
    {
        return $store->load('user');
    }

    public function update(Request $request, Store $store)
    {
        $data = $request->validate([
            'store_name' => 'nullable|string',
            'ruc' => 'nullable|string|unique:stores,ruc,' . $store->id,
            'logo' => 'nullable|string',
        ]);

        $store->update($data);
        return response()->json($store);
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return response()->noContent();
    }
}
