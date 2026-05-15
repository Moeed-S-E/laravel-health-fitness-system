@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">
            Welcome back, {{ Auth::user()->name }}!
            <i class="fa-solid fa-hand-sparkles text-warning"></i>
        </h2>

        <p class="text-muted mb-0">
            Here's your health & fitness overview
        </p>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-1"></i>
        New Task
    </a>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">

                <div class="fs-1 text-primary">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <div class="display-6 fw-bold text-primary">
                    {{ $total }}
                </div>

                <div class="text-muted small">
                    Total Tasks
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">

                <div class="fs-1 text-success">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="display-6 fw-bold text-success">
                    {{ $completed }}
                </div>

                <div class="text-muted small">
                    Completed
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">

                <div class="fs-1 text-warning">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>

                <div class="display-6 fw-bold text-warning">
                    {{ $pending }}
                </div>

                <div class="text-muted small">
                    Pending
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">

                <div class="fs-1 text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div class="display-6 fw-bold text-danger">
                    {{ $overdue }}
                </div>

                <div class="text-muted small">
                    Overdue
                </div>

            </div>
        </div>
    </div>

</div>

{{-- Progress Bar --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-2">

            <h5 class="card-title mb-0">
                <i class="fa-solid fa-chart-line text-success me-2"></i>
                Overall Completion
            </h5>

            <span class="fw-bold text-success">
                {{ $completionPct }}%
            </span>

        </div>

        <div class="progress" style="height: 22px; border-radius: 50px;">

            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                 role="progressbar"
                 style="width: {{ $completionPct }}%"
                 aria-valuenow="{{ $completionPct }}"
                 aria-valuemin="0"
                 aria-valuemax="100">

                {{ $completionPct }}%

            </div>

        </div>

        <div class="row text-center mt-3">

            <div class="col-4">
                <small class="text-muted">
                    <i class="fa-solid fa-circle-check text-success me-1"></i>
                    Completed
                </small>

                <div class="fw-bold text-success">
                    {{ $completed }}
                </div>
            </div>

            <div class="col-4">
                <small class="text-muted">
                    <i class="fa-solid fa-spinner text-primary me-1"></i>
                    In Progress
                </small>

                <div class="fw-bold text-primary">
                    {{ $inProgress }}
                </div>
            </div>

            <div class="col-4">
                <small class="text-muted">
                    <i class="fa-solid fa-clock text-warning me-1"></i>
                    Pending
                </small>

                <div class="fw-bold text-warning">
                    {{ $pending }}
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Recent Tasks --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fa-solid fa-clock-rotate-left me-2 text-success"></i>
            Recent Tasks
        </h5>

        <a href="{{ route('tasks.index') }}"
           class="btn btn-sm btn-outline-success">

            <i class="fa-solid fa-eye me-1"></i>
            View All

        </a>

    </div>

    <div class="card-body p-0">

        @if($recentTasks->isEmpty())

            <div class="text-center py-5 text-muted">

                <div class="fs-1 text-success">
                    <i class="fa-solid fa-seedling"></i>
                </div>

                <p class="mt-2">
                    No tasks yet. Start by creating one!
                </p>

                <a href="{{ route('tasks.create') }}" class="btn btn-success">

                    <i class="fa-solid fa-plus me-1"></i>
                    Create Task

                </a>

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Task</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($recentTasks as $task)

                        <tr>

                            <td>
                                <div class="fw-semibold">
                                    {{ $task->title }}
                                </div>

                                <small class="text-muted">
                                    {{ Str::limit($task->description, 40) }}
                                </small>
                            </td>

                            <td>
                                <span class="badge rounded-pill"
                                      style="background-color: {{ $task->category->color }}">

                                    <i class="{{ $task->category->icon }}"></i>
                                    {{ $task->category->name }}

                                </span>
                            </td>

                            <td>

                                @if($task->priority === 'high')

                                    <span class="badge bg-danger">
                                        <i class="fa-solid fa-arrow-up me-1"></i>
                                        High
                                    </span>

                                @elseif($task->priority === 'medium')

                                    <span class="badge bg-warning text-dark">
                                        <i class="fa-solid fa-minus me-1"></i>
                                        Medium
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        <i class="fa-solid fa-arrow-down me-1"></i>
                                        Low
                                    </span>

                                @endif

                            </td>

                            <td>

                                <small class="{{ $task->isOverdue() ? 'text-danger fw-bold' : 'text-muted' }}">

                                    <i class="fa-solid fa-calendar-days me-1"></i>

                                    {{ $task->due_date->format('M d, Y') }}

                                    @if($task->isOverdue())
                                        <i class="fa-solid fa-triangle-exclamation ms-1"></i>
                                    @endif

                                </small>

                            </td>

                            <td>

                                @if($task->status === 'completed')

                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-check me-1"></i>
                                        Completed
                                    </span>

                                @elseif($task->status === 'in-progress')

                                    <span class="badge bg-primary">
                                        <i class="fa-solid fa-spinner me-1"></i>
                                        In Progress
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        <i class="fa-solid fa-clock me-1"></i>
                                        Pending
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('tasks.show', $task) }}"
                                   class="btn btn-sm btn-outline-secondary">

                                    <i class="fa-solid fa-eye me-1"></i>
                                    View

                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection