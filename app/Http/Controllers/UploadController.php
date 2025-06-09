<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Subject; // Don't forget to import the Subject model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // For image file operations
use Illuminate\Validation\Rule;

class UploadController extends Controller
{
    // Define the fixed options for dropdowns
    private $examSeries = ['Internal', 'Private'];
    private $examTypes = ['WAEC', 'NECO', 'Nabteb', 'London GCE', 'Others'];
    private $grades = ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9', 'NA'];

    /**
     * Display a listing of the resource (uploads by the authenticated user).
     */
    public function index(Request $request)
    {
        $query = Auth::user()->uploads()->with('subject');

        // Optional: Search by exam number or subject name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('exam_number', 'like', '%' . $search . '%')
                  ->orWhereHas('subject', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        // Optional: Filter by exam year
        if ($request->filled('exam_year')) {
            $query->where('exam_year', $request->input('exam_year'));
        }

        // Optional: Filter by exam series
        if ($request->filled('exam_series') && in_array($request->input('exam_series'), $this->examSeries)) {
            $query->where('exam_series', $request->input('exam_series'));
        }

        // Optional: Filter by exam type
        if ($request->filled('exam_type') && in_array($request->input('exam_type'), $this->examTypes)) {
            $query->where('exam_type', $request->input('exam_type'));
        }

        $uploads = $query->latest()->paginate(10); // Paginate the results

        // Get all unique exam years from the user's uploads for the filter dropdown
        $availableExamYears = Auth::user()->uploads()->distinct()->pluck('exam_year')->sortDesc();

        return view('uploads.index', [
            'uploads' => $uploads,
            'examSeries' => $this->examSeries,
            'examTypes' => $this->examTypes,
            'availableExamYears' => $availableExamYears,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all(); // Get all subjects for the dropdown
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10); // Example: last 10 years for exam year

        return view('uploads.create', [
            'subjects' => $subjects,
            'examSeries' => $this->examSeries,
            'examTypes' => $this->examTypes,
            'grades' => $this->grades,
            'years' => $years,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exam_number' => 'required|string|max:255',
            'exam_year' => 'required|integer|min:1900|max:' . date('Y'),
            'subject_id' => [
                'required',
                'exists:subjects,id',
                // Unique constraint: same subject for same user, exam_number, and exam_year is not allowed
                Rule::unique('uploads')->where(function ($query) use ($request) {
                    return $query->where('user_id', Auth::id())
                                 ->where('exam_number', $request->exam_number)
                                 ->where('exam_year', $request->exam_year);
                }),
            ],
            'exam_series' => ['required', Rule::in($this->examSeries)],
            'exam_type' => ['required', Rule::in($this->examTypes)],
            'grade' => ['required', Rule::in($this->grades)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB image
        ]);

        $validatedData['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        Upload::create($validatedData);

        return redirect()->route('uploads.index')->with('success', 'Upload created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        // Authorization: Ensure user can only view their own uploads
        if ($upload->user_id !== Auth::id()) {
            abort(403);
        }

        // Get total subjects count for the authenticated user
        $totalSubjectsCount = Auth::user()->uploads()->count();

        return view('uploads.show', compact('upload', 'totalSubjectsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        // Authorization: Ensure user can only edit their own uploads
        if ($upload->user_id !== Auth::id()) {
            abort(403);
        }

        $subjects = Subject::all();
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);

        return view('uploads.edit', [
            'upload' => $upload,
            'subjects' => $subjects,
            'examSeries' => $this->examSeries,
            'examTypes' => $this->examTypes,
            'grades' => $this->grades,
            'years' => $years,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        // Authorization: Ensure user can only update their own uploads
        if ($upload->user_id !== Auth::id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'exam_number' => 'required|string|max:255',
            'exam_year' => 'required|integer|min:1900|max:' . date('Y'),
            'subject_id' => [
                'required',
                'exists:subjects,id',
                // Unique rule, ignoring the current upload's ID
                Rule::unique('uploads')->ignore($upload->id)->where(function ($query) use ($request) {
                    return $query->where('user_id', Auth::id())
                                 ->where('exam_number', $request->exam_number)
                                 ->where('exam_year', $request->exam_year);
                }),
            ],
            'exam_series' => ['required', Rule::in($this->examSeries)],
            'exam_type' => ['required', Rule::in($this->examTypes)],
            'grade' => ['required', Rule::in($this->grades)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image update/removal
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($upload->image_path) {
                Storage::disk('public')->delete($upload->image_path);
            }
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $validatedData['image_path'] = $imagePath;
        } elseif ($request->boolean('remove_image')) { // Check if checkbox for image removal is ticked
            if ($upload->image_path) {
                Storage::disk('public')->delete($upload->image_path);
            }
            $validatedData['image_path'] = null;
        } else {
            // If no new image uploaded and not explicitly removed, keep the existing one
            unset($validatedData['image']); // Remove from validated data to prevent error if it wasn't submitted
        }

        $upload->update($validatedData);

        return redirect()->route('uploads.index')->with('success', 'Upload updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        // Authorization: Ensure user can only delete their own uploads
        if ($upload->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete associated image if it exists
        if ($upload->image_path) {
            Storage::disk('public')->delete($upload->image_path);
        }

        $upload->delete();

        return redirect()->route('uploads.index')->with('success', 'Upload deleted successfully!');
    }
}