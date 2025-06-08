<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Extend the base Controller
use App\Models\Correction;          // Import the Correction model
use Illuminate\Http\Request;        // Import Request for handling input

class CorrectionDashboardController extends Controller
{
    /**
     * Display a listing of all correction entries with search functionality.
     *
     * This dashboard is intended for administrators to view and search all
     * submitted corrections, not just their own.
     */
    public function index(Request $request)
    {
        // Start a new query builder for the Correction model
        $query = Correction::query();

        // Eager load related models to prevent N+1 query problems.
        // We need 'user' to display who submitted it, and all institution/course
        // relations for display and search filtering.
        $query->with([
            'user',
            'institution1', 'course1',
            'institution2', 'course2',
            'institution3', 'course3',
            'institution4', 'course4',
        ]);

        // --- Search Functionality ---

        // Search by User Name or Email
        if ($request->filled('search_user')) {
            $searchUser = $request->input('search_user');
            $query->whereHas('user', function ($q) use ($searchUser) {
                $q->where('name', 'like', '%' . $searchUser . '%')
                  ->orWhere('email', 'like', '%' . $searchUser . '%');
            });
        }

        // Search by Institution Name (across all four institution fields)
        if ($request->filled('search_institution')) {
            $searchInstitution = $request->input('search_institution');
            $query->where(function ($q) use ($searchInstitution) {
                $q->orWhereHas('institution1', function ($q2) use ($searchInstitution) {
                    $q2->where('name', 'like', '%' . $searchInstitution . '%');
                })
                ->orWhereHas('institution2', function ($q2) use ($searchInstitution) {
                    $q2->where('name', 'like', '%' . $searchInstitution . '%');
                })
                ->orWhereHas('institution3', function ($q2) use ($searchInstitution) {
                    $q2->where('name', 'like', '%' . $searchInstitution . '%');
                })
                ->orWhereHas('institution4', function ($q2) use ($searchInstitution) {
                    $q2->where('name', 'like', '%' . $searchInstitution . '%');
                });
            });
        }

        // Search by Course Name (across all four course fields)
        if ($request->filled('search_course')) {
            $searchCourse = $request->input('search_course');
            $query->where(function ($q) use ($searchCourse) {
                $q->orWhereHas('course1', function ($q2) use ($searchCourse) {
                    $q2->where('name', 'like', '%' . $searchCourse . '%');
                })
                ->orWhereHas('course2', function ($q2) use ($searchCourse) {
                    $q2->where('name', 'like', '%' . $searchCourse . '%');
                })
                ->orWhereHas('course3', function ($q2) use ($searchCourse) {
                    $q2->where('name', 'like', '%' . $searchCourse . '%');
                })
                ->orWhereHas('course4', function ($q2) use ($searchCourse) {
                    $q2->where('name', 'like', '%' . $searchCourse . '%');
                });
            });
        }

        // Retrieve the paginated results of corrections.
        // You can adjust the number of items per page (e.g., 10).
        $corrections = $query->paginate(10);

        // Return the 'admin.corrections.index' view, passing the paginated corrections.
        return view('admin.corrections.index', compact('corrections'));
    }
}