<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'rank' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'year' => 'required|string|max:10',
            'description' => 'nullable|string',
            'certificate_url' => 'nullable|string',
        ]);

        $achievement = $request->user()->achievements()->create($validated);

        return response()->json([
            'message' => 'Prestasi berhasil ditambahkan',
            'data' => $achievement
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $achievement = $request->user()->achievements()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'rank' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'year' => 'required|string|max:10',
            'description' => 'nullable|string',
            'certificate_url' => 'nullable|string',
        ]);

        $achievement->update($validated);

        return response()->json([
            'message' => 'Prestasi berhasil diperbarui',
            'data' => $achievement
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $achievement = $request->user()->achievements()->findOrFail($id);
        $achievement->delete();

        return response()->json([
            'message' => 'Prestasi berhasil dihapus'
        ]);
    }
}