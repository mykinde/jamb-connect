<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // For raw queries if needed for counts

class UploadDashboardController extends Controller
{
    // Define the fixed options for dropdowns (replicated from UploadController for consistency)
    private $examSeries = ['Internal', 'Private'];
    private $examTypes = ['WAEC', 'NECO', 'Nabteb', 'London GCE', 'Others'];
    private $grades = ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9', 'NA'];

    /**
     * Display the admin dashboard for uploads.
     */
    public function index(Request $request)
    {
        $query = Upload::with(['user', 'subject']);

        // --- Filtering Logic ---

        // Filter by User
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        // Filter by Subject
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->input('subject_id'));
        }

        // Filter by Exam Year
        if ($request->filled('exam_year')) {
            $query->where('exam_year', $request->input('exam_year'));
        }

        // Filter by Exam Series
        if ($request->filled('exam_series') && in_array($request->input('exam_series'), $this->examSeries)) {
            $query->where('exam_series', $request->input('exam_series'));
        }

        // Filter by Exam Type
        if ($request->filled('exam_type') && in_array($request->input('exam_type'), $this->examTypes)) {
            $query->where('exam_type', $request->input('exam_type'));
        }

        // Filter by Grade
        if ($request->filled('grade') && in_array($request->input('grade'), $this->grades)) {
            $query->where('grade', $request->input('grade'));
        }

        // --- Search Logic ---
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('exam_number', 'like', '%' . $search . '%')
                  ->orWhereHas('subject', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function ($userQ) use ($search) {
                      $userQ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        $uploads = $query->latest()->paginate(20); // Paginate results for dashboard

        // --- Data for Filters & Statistics ---
        $allSubjects = Subject::orderBy('name')->get();
        $allUsers = User::orderBy('name')->get();
        $allExamYears = Upload::distinct()->pluck('exam_year')->sortDesc();

        $totalUploads = Upload::count();

        // Counts by Exam Type
        $uploadsByExamType = Upload::select('exam_type', DB::raw('count(*) as count'))
                                    ->groupBy('exam_type')
                                    ->pluck('count', 'exam_type')
                                    ->toArray();

        // Counts by Grade
        $uploadsByGrade = Upload::select('grade', DB::raw('count(*) as count'))
                                ->groupBy('grade')
                                ->pluck('count', 'grade')
                                ->toArray();

        // Counts by Exam Series
        $uploadsByExamSeries = Upload::select('exam_series', DB::raw('count(*) as count'))
                                    ->groupBy('exam_series')
                                    ->pluck('count', 'exam_series')
                                    ->toArray();

        return view('admin.uploads.dashboard', [
            'uploads' => $uploads,
            'allSubjects' => $allSubjects,
            'allUsers' => $allUsers,
            'allExamYears' => $allExamYears,
            'examSeriesOptions' => $this->examSeries,
            'examTypesOptions' => $this->examTypes,
            'gradeOptions' => $this->grades,

            'totalUploads' => $totalUploads,
            'uploadsByExamType' => $uploadsByExamType,
            'uploadsByGrade' => $uploadsByGrade,
            'uploadsByExamSeries' => $uploadsByExamSeries,
        ]);
    }
}