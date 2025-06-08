<?php

namespace App\Http\Controllers;

use App\Models\Correction;
use App\Models\Institution; // Import the Institution model for dropdowns
use App\Models\Course;       // Import the Course model for dropdowns
use App\Models\User;       // Import the Course model for dropdowns
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // For accessing the authenticated user

class CorrectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method shows a list of corrections submitted by the currently
     * authenticated user. Each user can only see their own submissions.
     */
    public function index()
    {
        // Retrieve corrections belonging to the authenticated user.
        // Eager load all related institution and course models for efficient display.
        $corrections = Auth::user()->corrections()->with([
            'institution1', 'course1',
            'institution2', 'course2',
            'institution3', 'course3',
            'institution4', 'course4',
        ])->paginate(10); // Paginate results for better performance and UI.

        // Return the view for displaying user-specific corrections.
        return view('corrections.index', compact('corrections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method prepares the form for submitting a new correction,
     * providing lists of all institutions and courses for dropdown selections.
     */
    public function create()
    {
        // Retrieve all institutions and courses to populate dropdowns in the form.
        $institutions = Institution::all();
        $courses = Course::all();

        // Return the view for creating a new correction.
        return view('corrections.create', compact('institutions', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method validates the incoming request data and stores a new
     * correction entry, associating it with the authenticated user.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data. All institution and course IDs are nullable.
        // They must exist in their respective tables if provided.
        $request->validate([
            'institution1_id' => 'nullable|exists:institutions,id',
            'course1_id' => 'nullable|exists:courses,id',
            'institution2_id' => 'nullable|exists:institutions,id',
            'course2_id' => 'nullable|exists:courses,id',
            'institution3_id' => 'nullable|exists:institutions,id',
            'course3_id' => 'nullable|exists:courses,id',
            'institution4_id' => 'nullable|exists:institutions,id',
            'course4_id' => 'nullable|exists:courses,id',
        ]);

        // Create the correction record, automatically setting the user_id
        // because of the `corrections()` relationship on the User model.
        Auth::user()->corrections()->create($request->all());

        // Redirect to the user's corrections index page with a success message.
        return redirect()->route('corrections.index')->with('success', 'Correction submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * This method displays the details of a single correction.
     * It includes an authorization check to ensure only the owner can view it.
     */
    public function show(Correction $correction)
    {
        // Check if the authenticated user is the owner of this correction.
        // If not, abort with a 403 Forbidden error.
        if ($correction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Return the view to show the specific correction details.
        return view('corrections.show', compact('correction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method prepares the form for editing an existing correction,
     * pre-populating it with the correction's current data and providing
     * lists of all institutions and courses for dropdowns.
     * It includes an authorization check.
     */
    public function edit(Correction $correction)
    {
        // Check if the authenticated user is the owner of this correction.
        if ($correction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Retrieve all institutions and courses for the dropdowns.
        $institutions = Institution::all();
        $courses = Course::all();

        // Return the view for editing the correction.
        return view('corrections.edit', compact('correction', 'institutions', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * This method validates the incoming request data and updates an
     * existing correction entry in the database.
     * It includes an authorization check.
     */
    public function update(Request $request, Correction $correction)
    {
        // Check if the authenticated user is the owner of this correction.
        if ($correction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the incoming request data for update.
        $request->validate([
            'institution1_id' => 'nullable|exists:institutions,id',
            'course1_id' => 'nullable|exists:courses,id',
            'institution2_id' => 'nullable|exists:institutions,id',
            'course2_id' => 'nullable|exists:courses,id',
            'institution3_id' => 'nullable|exists:institutions,id',
            'course3_id' => 'nullable|exists:courses,id',
            'institution4_id' => 'nullable|exists:institutions,id',
            'course4_id' => 'nullable|exists:courses,id',
        ]);

        // Update the correction with the validated data.
        $correction->update($request->all());

        // Redirect to the user's corrections index page with a success message.
        return redirect()->route('corrections.index')->with('success', 'Correction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * This method deletes a correction record from the database.
     * It includes an authorization check.
     */
    public function destroy(Correction $correction)
    {
        // Check if the authenticated user is the owner of this correction.
        if ($correction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the correction.
        $correction->delete();

        // Redirect to the user's corrections index page with a success message.
        return redirect()->route('corrections.index')->with('success', 'Correction deleted successfully.');
    }
}