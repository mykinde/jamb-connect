<?php

namespace App\Http\Controllers;

        use App\Models\Course;
        use App\Models\Category;
        use Illuminate\Http\Request;

        class CourseController extends Controller
        {
            public function index(Request $request)
            {
                $query = Course::query();

                if ($request->filled('search')) {
                    $search = $request->input('search');
                    $query->where('name', 'like', '%'.$search.'%');
                }

                if ($request->filled('category_id')) {
                    $query->where('category_id', $request->input('category_id'));
                }

                $courses = $query->with('category')->paginate(10); // Adjust pagination as needed
                $categories = Category::all();

                return view('courses.index', compact('courses', 'categories'));
            }

            public function create()
            {
                $categories = Category::all();
                return view('courses.create', compact('categories'));
            }

            public function store(Request $request)
            {
                $request->validate([
                    'name' => 'required|string|max:255|unique:courses,name',
                    'category_id' => 'required|exists:categories,id',
                ]);

                Course::create($request->all());

                return redirect()->route('courses.index')->with('success', 'Course created successfully.');
            }

            // ... show, edit, update, destroy methods (similar to InstitutionController)
            public function show(Course $course)
            {
                return view('courses.show', compact('course'));
            }

            public function edit(Course $course)
            {
                $categories = Category::all();
                return view('courses.edit', compact('course', 'categories'));
            }

            public function update(Request $request, Course $course)
            {
                $request->validate([
                    'name' => 'required|string|max:255|unique:courses,name,'.$course->id,
                    'category_id' => 'required|exists:categories,id',
                ]);

                $course->update($request->all());

                return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
            }

            public function destroy(Course $course)
            {
                $course->delete();
                return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
            }
        }
    