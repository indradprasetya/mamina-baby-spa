<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Child::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $child = Child::create($validated);
        return response()->json($child, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return response()->json(null, 204); // 204 berarti proses berhasil tapi tidak ada konten yang dikirim
    }
}
