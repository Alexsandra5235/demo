<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarService
{
    public function validate(Request $request) : void
    {
        $request->validate([
            'images' => 'required|max:2048',
        ]);
    }
    public function update(Profile $user, $path) : void
    {
        $this->delete($user->avatar()->first()->avatar_path);
        $user->avatar()->updateOrCreate(
            [],
            ['avatar_path' => $path]
        );
    }
    public function delete($imagePath) : void
    {
        if ($imagePath != null) {

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }
}
