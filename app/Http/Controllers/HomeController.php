<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_courses'    => Course::count(),
            'total_categories' => Course::distinct()->count('category'),
        ];

        return view('home', compact('stats'));
    }
}
