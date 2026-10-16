<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Throwable;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'category' => 'nullable|string|max:255',
                'level'    => 'nullable|string|max:100',
            ]);

            $skill = $request->user()->skills()->create([
                'name'     => $validated['name'],
                'category' => $validated['category'] ?? 'Soft Skill',
                'level'    => $validated['level'] ?? 'Pemula',
            ]);

            return response()->json([
                'message' => 'Keahlian berhasil ditambahkan',
                'data'    => $skill
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $skill = $request->user()->skills()->findOrFail($id);
            $skill->delete();

            return response()->json([
                'message' => 'Keahlian berhasil dihapus'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}