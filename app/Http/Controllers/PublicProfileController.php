<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        // Only show profiles for workers
        if ($user->role !== 'worker') {
            abort(404, 'Profile not found.');
        }

        // Load all necessary relationships
        $user->load([
            'profile', 
            'userSkills.skill', 
            'userLanguages.language', 
            'educationRecords', 
            'references'
        ]);
        
        return view('public.profile', compact('user'));
    }
}

