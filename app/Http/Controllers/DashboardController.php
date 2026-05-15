<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    $user = auth()->user();
    $tasks = $user->tasks()->with('category')->get();

    return view('dashboard', [
        'total'       => $tasks->count(),
        'completed'   => $tasks->where('status', 'completed')->count(),
        'pending'     => $tasks->where('status', 'pending')->count(),
        'inProgress'  => $tasks->where('status', 'in-progress')->count(),
        'overdue'     => $tasks->filter(fn($t) => $t->isOverdue())->count(),
        'recentTasks' => $tasks->sortByDesc('created_at')->take(5),
        'completionPct' => $tasks->count()
            ? round($tasks->where('status','completed')->count() / $tasks->count() * 100)
            : 0,
    ]);
}
}
