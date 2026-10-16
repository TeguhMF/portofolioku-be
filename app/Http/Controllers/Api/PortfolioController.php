<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'profile' => $user->profile,
            'achievements' => $user->achievements()->latest()->get(),
            'organizations' => $user->organizations()->latest()->get(),
            'projects' => $user->projects()->latest()->get(),
            'skills' => $user->skills,
            'builder_settings' => $user->builderSetting,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:profiles,username,' . ($user->profile->id ?? 'NULL'),
            'school_name' => 'nullable|string|max:255',
            'grade_level' => 'nullable|string|max:255',
            'career_goal' => 'nullable|string|max:255',
            'phone_whatsapp' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'avatar_url' => 'nullable|string',
            'social_links' => 'nullable',
        ]);

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'profile' => $profile
        ]);
    }

    public function publicShow($username)
    {
        $profile = \App\Models\Profile::where('username', $username)->firstOrFail();
        $user = $profile->user;

        return response()->json([
            'profile' => $profile,
            'achievements' => $user->achievements()->latest()->get(),
            'organizations' => $user->organizations()->latest()->get(),
            'projects' => $user->projects()->latest()->get(),
            'skills' => $user->skills,
            'builder_settings' => $user->builderSetting,
        ]);
    }
}