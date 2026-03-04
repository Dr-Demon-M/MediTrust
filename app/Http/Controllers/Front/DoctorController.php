<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('specialty')->get();
        return view('front.doctors.index', compact('doctors'));
    }

    public function search(Request $request)
    {

        $query = Doctor::with('specialty');

        if ($request->doctor_name) {
            $query->where('name', 'like', '%' . $request->doctor_name . '%');
        }

        if ($request->specialty_id) {
            $query->where('specialty_id', $request->specialty_id);
        }

        return response()->json($query->get());
    }
}
