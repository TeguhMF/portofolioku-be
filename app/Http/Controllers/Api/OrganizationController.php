<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Throwable;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'organization_name' => 'required|string|max:255',
                'role'              => 'required|string|max:255',
                'period'            => 'nullable|string|max:100',
                'description'       => 'nullable|string',
            ]);

            $organization = $request->user()->organizations()->create([
                'organization_name' => $validated['organization_name'],
                'role'              => $validated['role'],
                'period'            => $validated['period'] ?? '-',
                'description'       => $validated['description'] ?? '',
            ]);

            return response()->json([
                'message' => 'Organisasi berhasil ditambahkan',
                'data'    => $organization
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
            $organization = $request->user()->organizations()->findOrFail($id);
            $organization->delete();

            return response()->json([
                'message' => 'Organisasi berhasil dihapus'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}