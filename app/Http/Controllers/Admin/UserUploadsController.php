<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Import the User model
use App\Models\Subject; // Import Subject for filters in show_uploads
use App\Models\Upload;  // Import Upload for filters in show_uploads
use Illuminate\Http\Request;

class UserUploadsController extends Controller
{
    // Define the fixed options for dropdowns (replicated for consistency)
    private $examSeries = ['Internal', 'Private'];
    private $examTypes = ['WAEC', 'NECO', 'Nabteb', 'London GCE', 'Others'];
    private $grades = ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9', 'NA'];

    /**
     * Display a list of users for admin to view their uploads.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality for users by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $query->withCount('uploads') // Get count of uploads for each user
                       ->orderBy('name')
                       ->paginate(15);

        return view('admin.user_uploads.index', [
            'users' => $users,
            'searchQuery' => $request->input('search'),
        ]);
    }

    /**
     * Display a specific user's aggregate uploads for admin.
     */
    public function show(Request $request, User $user)
    {
        // Authorization: Ensure this route is protected by admin middleware
        // For example, you might add a policy or gate check here:
        // $this->authorize('viewUserUploads', $user); // if using policies

        $uploadsQuery = $user->uploads()->with('subject');

        // --- Filtering Logic (similar to main UploadController index) ---

        // Optional: Search by exam number or subject name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $uploadsQuery->where('exam_number', 'like', '%' . $search . '%')
                  ->orWhereHas('subject', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        // Optional: Filter by exam year
        if ($request->filled('exam_year')) {
            $uploadsQuery->where('exam_year', $request->input('exam_year'));
        }

        // Optional: Filter by exam series
        if ($request->filled('exam_series') && in_array($request->input('exam_series'), $this->examSeries)) {
            $uploadsQuery->where('exam_series', $request->input('exam_series'));
        }

        // Optional: Filter by exam type
        if ($request->filled('exam_type') && in_array($request->input('exam_type'), $this->examTypes)) {
            $uploadsQuery->where('exam_type', $request->input('exam_type'));
        }

        $uploads = $uploadsQuery->latest()->paginate(10);

        // Get all unique exam years from this specific user's uploads for the filter dropdown
        $availableExamYearsForUser = $user->uploads()->distinct()->pluck('exam_year')->sortDesc();

        return view('admin.user_uploads.show_uploads', [
            'user' => $user,
            'uploads' => $uploads,
            'examSeries' => $this->examSeries,
            'examTypes' => $this->examTypes,
            'grades' => $this->grades,
            'availableExamYears' => $availableExamYearsForUser,
        ]);
    }
}