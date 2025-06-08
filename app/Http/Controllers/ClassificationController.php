<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all classifications from the database
        $classifications = Classification::all();

        // Return the index view, passing the classifications data
        return view('classifications.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view for classifications
        return view('classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:classifications,name', // Name is required, string, max 255 chars, and unique in the classifications table
        ]);

        // Create a new Classification instance with the validated data
        Classification::create($request->all());

        // Redirect to the classifications index with a success message
        return redirect()->route('classifications.index')->with('success', 'Classification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        // Return the show view, passing the specific classification data
        return view('classifications.show', compact('classification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        // Return the edit view, passing the specific classification data
        return view('classifications.edit', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classification $classification)
    {
        // Validate the incoming request data for update
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure the name is unique, ignoring the current classification's ID
                Rule::unique('classifications')->ignore($classification->id),
            ],
        ]);

        // Update the classification with the validated data
        $classification->update($request->all());

        // Redirect to the classifications index with a success message
        return redirect()->route('classifications.index')->with('success', 'Classification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        // Delete the classification from the database
        $classification->delete();

        // Redirect to the classifications index with a success message
        return redirect()->route('classifications.index')->with('success', 'Classification deleted successfully.');
    }
}