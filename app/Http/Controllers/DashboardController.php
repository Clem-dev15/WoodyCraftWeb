<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $puzzles = Puzzle::query()
            ->when($search, function ($query, $search) {
                $query->where('nom', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard', compact('puzzles', 'search'));
    }
}