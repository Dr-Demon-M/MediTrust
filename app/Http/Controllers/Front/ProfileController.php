<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ProfileController extends Controller
{
    public function index(HttpFoundationRequest $request)
    {
        return view('front.profile.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:0|max:120',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'blood_group' => 'nullable|string|max:3',
            'medical_history' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf',
            'address' => 'nullable|string|max:255',
        ]);
        $image = $request->file('profile_image');
        $attachments = $request->file('attachments');

        foreach ($attachments as $attachment) {
            $path = $attachment->store('patients/attachments', 'public');
            $validated['attachments'][] = $path;
        }

        if ($image) {
            $path = $image->store('patients', 'public');
            $validated['profile_image'] = $path;
        }

        $user = Auth::guard('patient')->user();
        $user->update($validated);
        return redirect()->route('front.profile.index')->with('success', 'Profile updated successfully.');
    }
}
