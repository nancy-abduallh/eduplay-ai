<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCategoryJob;
use App\Models\FetchSession;
use Illuminate\Http\Request;

class FetchController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'categories' => 'required|string|min:1',
        ]);

        $raw        = explode("\n", $request->input('categories'));
        $categories = array_values(array_filter(array_map('trim', $raw)));

        if (empty($categories)) {
            return back()->withErrors(['categories' => 'Please enter at least one category.'])->withInput();
        }

        $session = FetchSession::create([
            'status'               => 'pending',
            'categories'           => $categories,
            'total_categories'     => count($categories),
            'processed_categories' => 0,
            'total_found'          => 0,
        ]);

        foreach ($categories as $category) {
            ProcessCategoryJob::dispatch($session->id, $category);
        }

        return redirect()->route('fetch.progress', $session->id);
    }

    public function progress(FetchSession $session)
    {
        return view('fetch.progress', compact('session'));
    }

    public function status(FetchSession $session)
    {
        return response()->json([
            'status'     => $session->status,
            'processed'  => $session->processed_categories,
            'total'      => $session->total_categories,
            'found'      => $session->total_found,
            'percentage' => $session->percentage,
        ]);
    }
}
