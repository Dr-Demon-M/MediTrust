<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    public function Store(ProfileRequest $request)
    {

        $user_id = Auth::user()->id;
        $data = $request->validated();
        $data['user_id'] = $user_id;
        $profile = profile::create($data);
        return response()->json([
            'message' => 'profile Created Successfully',
            'user' => $data
        ], 201);
    }


    public function index()
    {
        $all = profile::select('user_id', 'name', 'phone', 'address')->get();
        return response()->json($all, 201);
    }


    public function getoneprofile($id)
    {
        $profile = User::findOrFail($id)
            ->profile()
            ->select('user_id', 'name', 'phone', 'address')
            ->first();
        return response()->json($profile, 200);
    }


    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user()->profile;
        $user->update($request->validated());
        return response()->json([
            'message' => 'user updated successfully',
            'name' =>  $user['name'],
            'phone' =>  $user['phone'],
            'address' =>  $user['address'],
        ], 202);
    }

    public function destroy()
    {
        $user = Auth::user()->profile;
        $user->delete();
        return response()->json("User deleted Successfully", 200);
    }
}
