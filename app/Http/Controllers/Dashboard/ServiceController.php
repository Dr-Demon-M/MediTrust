<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{

// public function __construct() 
// {
//     $this->authorizeResource(Service::class, 'service');
// }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialities = Specialty::with('services')->get();
        return view('Dashboard.services.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialities = Specialty::all();
        return view('Dashboard.services.create', compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|in:15,30,45,60',
            'featured_service' => 'sometimes|boolean',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);
        Service::create($validatedData);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|in:15,30,45,60',
            'featured_service' => 'sometimes|boolean',
        ]);
        $service->update($validatedData);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.index')->with('delete', 'Service Deleted Successfully');
    }


    public function featured()
    {
        $specialities = Specialty::with(['services' => function ($query) {
            $query->where('featured_service', true);
        }])->get();
        return view('Dashboard.services.featured', compact('specialities'));
    }


    public function updateFeatured(Request $request)
    {
        $selected = $request->input('featured_services', []);
        DB::transaction(function () use ($selected) {
            Service::where('featured_service', 1)
                ->update(['featured_service' => 0]);
            if (!empty($selected)) {
                Service::whereIn('id', $selected)
                    ->update(['featured_service' => 1]);
            }
        });
        return response()->json([
            'success' => true
        ]);
    }
}
