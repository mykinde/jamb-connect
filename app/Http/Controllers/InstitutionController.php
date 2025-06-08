<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Category; // Don't forget to import Category
use App\Models\Classification; // Don't forget to import Classification
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Needed for unique rule in update method

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method handles displaying all institutions with search and filter
     * capabilities based on name/location, category, and classification.
     */
    public function index(Request $request)
    {
        // Start a new query builder for the Institution model
        $query = Institution::query();

        // Apply search filter if 'search' input is present
        if ($request->filled('search')) {
            $search = $request->input('search');
            // Search by institution name or location (case-insensitive with 'like')
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
        }

        // Apply category filter if 'category_id' input is present
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Apply classification filter if 'classification_id' input is present
        if ($request->filled('classification_id')) {
            $query->where('classification_id', $request->input('classification_id'));
        }

        // Retrieve institutions, eagerly loading their associated category and classification,
        // and paginate the results to 10 items per page.
        $institutions = $query->with('category', 'classification')->paginate(10); // Adjust pagination as needed

        // Retrieve all categories and classifications to populate filter dropdowns
        $categories = Category::all();
        $classifications = Classification::all();

        // Return the 'institutions.index' view, passing the filtered/paginated institutions,
        // and all categories/classifications for the filter forms.
        return view('institutions.index', compact('institutions', 'categories', 'classifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method prepares the form for creating a new institution,
     * providing lists of categories and classifications for dropdowns.
     */
    public function create()
    {
        // Retrieve all categories and classifications to populate dropdowns in the form
        $categories = Category::all();
        $classifications = Classification::all();

        // Return the 'institutions.create' view, passing these lists
        return view('institutions.create', compact('categories', 'classifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method validates the incoming request data and creates a new
     * institution entry in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name', // Name must be unique
            'category_id' => 'required|exists:categories,id', // Must be a valid category ID
            'classification_id' => 'required|exists:classifications,id', // Must be a valid classification ID
            'location' => 'required|string|max:255',
        ]);

        // Create the institution using the validated data
        Institution::create($request->all());

        // Redirect to the institutions index page with a success message
        return redirect()->route('institutions.index')->with('success', 'Institution created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * This method displays the details of a single institution.
     */
    public function show(Institution $institution)
    {
        // Return the 'institutions.show' view, passing the specific institution data
        return view('institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method prepares the form for editing an existing institution,
     * pre-populating it with the institution's current data and lists of
     * categories and classifications for dropdowns.
     */
    public function edit(Institution $institution)
    {
        // Retrieve all categories and classifications for the dropdowns
        $categories = Category::all();
        $classifications = Classification::all();

        // Return the 'institutions.edit' view, passing the institution data
        // and the lists of categories/classifications.
        return view('institutions.edit', compact('institution', 'categories', 'classifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * This method validates the incoming request data and updates an
     * existing institution entry in the database.
     */
    public function update(Request $request, Institution $institution)
    {
        // Validate the request data for update
        $request->validate([
            // Name must be unique, but ignore the current institution's own name (its ID)
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('institutions')->ignore($institution->id),
            ],
            'category_id' => 'required|exists:categories,id',
            'classification_id' => 'required|exists:classifications,id',
            'location' => 'required|string|max:255',
        ]);

        // Update the institution with the validated data
        $institution->update($request->all());

        // Redirect to the institutions index page with a success message
        return redirect()->route('institutions.index')->with('success', 'Institution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * This method deletes an institution record from the database.
     */
    public function destroy(Institution $institution)
    {
        // Delete the institution
        $institution->delete();

        // Redirect to the institutions index page with a success message
        return redirect()->route('institutions.index')->with('success', 'Institution deleted successfully.');
    }
}