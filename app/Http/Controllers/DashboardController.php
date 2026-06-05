<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user's productivity dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        // Calculate statistics
        $totalCount = $user->tasks()->count();
        $completedCount = $user->tasks()->where('status', 'Completed')->count();
        $pendingCount = $user->tasks()->where('status', 'Pending')->count();

        // Overdue: Status = Pending, Due Date < Current Date
        $overdueCount = $user->tasks()
            ->where('status', 'Pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', today())
            ->count();

        // Calculate progress percentage
        $progressPercent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

        // Fetch recent tasks (latest 5) with category eager loaded
        $recentTasks = $user->tasks()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalCount',
            'completedCount',
            'pendingCount',
            'overdueCount',
            'progressPercent',
            'recentTasks'
        ));
    }
}
