<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
{
    $query = Course::query();

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('search')) {
        $search = '%' . $request->search . '%';
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', $search)
              ->orWhere('channel_name', 'like', $search)
              ->orWhere('description', 'like', $search);
        });
    }

    $filteredTotal = $query->count();

    $courses = $query->latest()->paginate(12)->withQueryString();

    $categories = Course::distinct()->orderBy('category')->pluck('category');
    $total = Course::count();

    return view('courses.index', compact('courses', 'categories', 'total', 'filteredTotal'));
}

    public function show(Course $course)
    {
        $related = Course::where('category', $course->category)
            ->where('id', '!=', $course->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('courses.show', compact('course', 'related'));
    }
}
