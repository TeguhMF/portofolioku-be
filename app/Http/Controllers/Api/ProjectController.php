<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Throwable;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'category'    => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'tools'       => 'nullable|string|max:255',
                'file_url'    => 'nullable|string|max:255',
                'image_url'   => 'nullable|string',
            ]);

            $project = $request->user()->projects()->create($validated);

            return response()->json([
                'message' => 'Karya berhasil ditambahkan',
                'data'    => $project
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
            $project = $request->user()->projects()->findOrFail($id);
            $project->delete();

            return response()->json([
                'message' => 'Karya berhasil dihapus'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}