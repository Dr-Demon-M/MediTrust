<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Patient::class, 'patient');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('Dashboard.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $attachments = $patient->attachments;
        $history = $patient->medical_history;
        return view('Dashboard.patients.show', compact('patient', 'attachments', 'history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('Dashboard.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $medicalHistoryArray = array_map('trim', explode(',', $request->input('medical_history')));
        $patient->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'blood_group' => $request->input('blood_group'),
            'medical_history' => $medicalHistoryArray,
            'address' => $request->input('address'),
        ]);
        $attachments = $patient->attachments ?? [];

        /* حذف الملفات */
        if ($request->delete_attachments) {

            foreach ($request->delete_attachments as $file) {

                Storage::disk('public')->delete($file);

                $attachments = array_values(
                    array_diff($attachments, [$file])
                );
            }
        }

        /* إضافة ملفات جديدة */
        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $path = $file->store('patients/attachments', 'public');

                $attachments[] = $path;
            }
        }

        $patient->update([
            'attachments' => $attachments
        ]);
        return redirect()->route('patients.index')->with('info', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('error', 'Patient deleted successfully.');
    }

    public function consultation()
    {
        $chats = auth()->user()->doctor->conversations()->with('patient')->get();
        return view('Dashboard.patients.consultation', compact('chats'));
    }

    public function deleteAttachment(Request $request)
    {
        $patient = Patient::findOrFail($request->patient_id);
        $attachments = $patient->attachments ?? [];
        Storage::disk('public')->delete($request->file);
        $attachments = array_values(array_diff($attachments, [$request->file]));
        $patient->update([
            'attachments' => $attachments
        ]);
        return response()->json([
            'success' => true
        ]);
    }
}
