<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Needed for unique rule in update method

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all types from the database
        $types = Type::all();

        // Return the index view, passing the types data
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view for types
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name', // Name is required, string, max 255 chars, and unique in the types table
        ]);

        // Create a new Type instance with the validated data
        Type::create($request->all());

        // Redirect to the types index with a success message
        return redirect()->route('types.index')->with('success', 'Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        // Return the show view, passing the specific type data
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        // Return the edit view, passing the specific type data
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // Validate the incoming request data for update
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure the name is unique, ignoring the current type's ID
                Rule::unique('types')->ignore($type->id),
            ],
        ]);

        // Update the type with the validated data
        $type->update($request->all());

        // Redirect to the types index with a success message
        return redirect()->route('types.index')->with('success', 'Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        // Delete the type from the database
        $type->delete();

        // Redirect to the types index with a success message
        return redirect()->route('types.index')->with('success', 'Type deleted successfully.');
    }
}
