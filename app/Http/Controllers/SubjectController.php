<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Type; // Import the Type model for the dropdown
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Needed for unique rule in update method

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subject::query()->with('type'); // Eager load the type relationship

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Filter by type
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }

        $subjects = $query->paginate(10); // Paginate the results
        $types = Type::all(); // Get all types for the filter dropdown

        return view('subjects.index', compact('subjects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all(); // Get all types for the dropdown
        return view('subjects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'type_id' => 'required|exists:types,id', // Type ID must exist in types table
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $types = Type::all(); // Get all types for the dropdown
        return view('subjects.edit', compact('subject', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects')->ignore($subject->id), // Ignore current subject's ID for unique check
            ],
            'type_id' => 'required|exists:types,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}