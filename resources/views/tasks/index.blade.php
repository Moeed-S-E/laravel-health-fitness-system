@extends('layouts.app')
@section('title', 'My Tasks')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold mb-0">
        <i class="fa-solid fa-list-check text-success me-2"></i>
        My Tasks
    </h2>

    <a href="{{ route('tasks.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-1"></i>
        New Task
    </a>

</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form method="GET"
              action="{{ route('tasks.index') }}"
              class="row g-3 align-items-end">

            <div class="col-md-3">

                <label class="form-label fw-semibold">
                    <i class="fa-solid fa-layer-group me-1"></i>
                    Category
                </label>

                <select name="category" class="form-select">

                    <option value="">All Categories</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                        <i class="{{ $category->icon }}"></i>
                             {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <label class="form-label fw-semibold">
                    <i class="fa-solid fa-bars-progress me-1"></i>
                    Status
                </label>

                <select name="status" class="form-select">

                    <option value="">All Statuses</option>

                    <option value="pending"
                        {{ request('status') === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="in-progress"
                        {{ request('status') === 'in-progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="completed"
                        {{ request('status') === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <label class="form-label fw-semibold">
                    <i class="fa-solid fa-flag me-1"></i>
                    Priority
                </label>

                <select name="priority" class="form-select">

                    <option value="">All Priorities</option>

                    <option value="high"
                        {{ request('priority') === 'high' ? 'selected' : '' }}>
                        High
                    </option>

                    <option value="medium"
                        {{ request('priority') === 'medium' ? 'selected' : '' }}>
                        Medium
                    </option>

                    <option value="low"
                        {{ request('priority') === 'low' ? 'selected' : '' }}>
                        Low
                    </option>

                </select>

            </div>

            <div class="col-md-3 d-flex gap-2">

                <button type="submit" class="btn btn-success w-100">
                    <i class="fa-solid fa-filter me-1"></i>
                    Filter
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-outline-secondary w-100">

                    <i class="fa-solid fa-rotate-right me-1"></i>
                    Reset

                </a>

            </div>

        </form>

    </div>

</div>

{{-- Task List --}}
@if($tasks->isEmpty())

    <div class="text-center py-5 text-muted">

        <div class="fs-1 text-success">
            <i class="fa-solid fa-seedling"></i>
        </div>

        <p class="mt-2">
            No tasks found. Try a different filter or create a new task.
        </p>

        <a href="{{ route('tasks.create') }}" class="btn btn-success">

            <i class="fa-solid fa-plus me-1"></i>
            Create Task

        </a>

    </div>

@else

    <div class="row g-3">

        @foreach($tasks as $task)

        <div class="col-md-6 col-lg-4">

            <div class="card border-0 shadow-sm h-100 {{ $task->isOverdue() ? 'border-danger border' : '' }}">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <span class="badge rounded-pill"
                          style="background-color: {{ $task->category->color }}">

                        <i class="{{ $task->category->icon }}"></i>
                        {{ $task->category->name }}

                    </span>

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

                </div>

                <div class="card-body">

                    <h5 class="card-title fw-bold">
                        {{ $task->title }}
                    </h5>

                    <p class="card-text text-muted small">
                        {{ Str::limit($task->description, 80) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-2">

                        <small class="{{ $task->isOverdue() ? 'text-danger fw-bold' : 'text-muted' }}">

                            <i class="fa-solid fa-calendar-days me-1"></i>

                            {{ $task->due_date->format('M d, Y') }}

                            @if($task->isOverdue())

                                <i class="fa-solid fa-triangle-exclamation ms-1"></i>
                                Overdue

                            @endif

                        </small>

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

                    </div>

                </div>

                <div class="card-footer bg-white d-flex gap-2">

                    <a href="{{ route('tasks.show', $task) }}"
                       class="btn btn-sm btn-outline-secondary flex-fill">

                        <i class="fa-solid fa-eye me-1"></i>
                        View

                    </a>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="btn btn-sm btn-outline-primary flex-fill">

                        <i class="fa-solid fa-pen-to-square me-1"></i>
                        Edit

                    </a>

                    @if($task->status !== 'completed')

                        <form method="POST"
                              action="{{ route('tasks.complete', $task) }}">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-sm btn-success">

                                <i class="fa-solid fa-check"></i>

                            </button>

                        </form>

                    @endif

                    <form method="POST"
                          action="{{ route('tasks.destroy', $task) }}"
                          onsubmit="return confirm('Delete this task?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-outline-danger">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="mt-4">
        {{ $tasks->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

@endif

@endsection