<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Extend the base Controller
use App\Models\User;                // Import the User model
use App\Models\Institution;         // Import the Institution model
use App\Models\Course;              // Import the Course model
use App\Models\Correction;          // Import the Correction model
use App\Models\Category;            // Import the Category model
use App\Models\Classification;      // Import the Classification model

class ReportDashboardController extends Controller
{
    /**
     * Display the main report dashboard with various aggregate counts.
     *
     * This method fetches total counts for key entities (users, institutions,
     * courses, corrections) and also provides breakdowns by category and classification
     * for institutions and courses.
     */
    public function index()
    {
        // Total counts for key entities
        $totalUsers = User::count();
        $totalInstitutions = Institution::count();
        $totalCourses = Course::count();
        $totalCorrections = Correction::count();

        // Institutions count by Category
        // Using withCount to efficiently get the count of related institutions for each category
        // Ordered by the count in descending order for better reporting
        $institutionsByCategory = Category::withCount('institutions')
                                            ->orderByDesc('institutions_count')
                                            ->get();

        // Courses count by Category
        // Using withCount to efficiently get the count of related courses for each category
        // Ordered by the count in descending order
        $coursesByCategory = Category::withCount('courses')
                                        ->orderByDesc('courses_count')
                                        ->get();

        // Institutions count by Classification
        // Using withCount to efficiently get the count of related institutions for each classification
        // Ordered by the count in descending order
        $institutionsByClassification = Classification::withCount('institutions')
                                                        ->orderByDesc('institutions_count')
                                                        ->get();

        // Return the 'admin.reports.index' view, passing all the calculated statistics
        return view('admin.reports.index', compact(
            'totalUsers',
            'totalInstitutions',
            'totalCourses',
            'totalCorrections',
            'institutionsByCategory',
            'coursesByCategory',
            'institutionsByClassification'
        ));
    }
}