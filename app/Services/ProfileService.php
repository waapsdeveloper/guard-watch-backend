<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Space;
use App\Models\User;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function add($data)
    {
        $user = Auth::user();

        // Check if a profile with the same title already exists
        $existingProfile = Profile::where('title', $data['title'])->first();

        if ($existingProfile) {
            return ServiceResponse::error('Profile Already Exists with Title');
        }

        // Create a new profile
        $profile = new Profile();

        // Find the associated space and user
        $space = Space::findOrFail($data['space_id']);
        $user = User::findOrFail($data['user_id']);

        // Set profile data
        $profile->fill([
            'title' => $data['title'],
            'description' => $data['description'],
            'last_active_hour' => $data['last_active_hour'],
            'picture' => $data['picture'],
        ]);

        // Save the profile
        $profile->save();

        // Create a resource for the profile
        $resource = new ProfileResource($profile);

        // Return success response with the created resource
        return ServiceResponse::success('Profile Added', $resource);
    }
}
