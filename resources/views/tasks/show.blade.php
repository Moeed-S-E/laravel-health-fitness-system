@extends('layouts.app')
@section('title', $task->title)

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="d-flex align-items-center mb-4">

            <a href="{{ route('tasks.index') }}"
               class="btn btn-outline-secondary me-3">

                <i class="fa-solid fa-arrow-left me-1"></i>
                Back

            </a>

            <h2 class="fw-bold mb-0">

                <i class="fa-solid fa-clipboard-list text-success me-2"></i>
                Task Detail

            </h2>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">

                <div class="d-flex align-items-center gap-2">

                    <span class="badge rounded-pill fs-6"
                          style="background-color: {{ $task->category->color }}">

                        <i class="{{ $task->category->icon }}"></i>
                        {{ $task->category->name }}

                    </span>

                    @if($task->priority === 'high')

                        <span class="badge bg-danger">

                            <i class="fa-solid fa-arrow-up me-1"></i>
                            High Priority

                        </span>

                    @elseif($task->priority === 'medium')

                        <span class="badge bg-warning text-dark">

                            <i class="fa-solid fa-minus me-1"></i>
                            Medium Priority

                        </span>

                    @else

                        <span class="badge bg-secondary">

                            <i class="fa-solid fa-arrow-down me-1"></i>
                            Low Priority

                        </span>

                    @endif

                </div>

                @if($task->status === 'completed')

                    <span class="badge bg-success fs-6">

                        <i class="fa-solid fa-check me-1"></i>
                        Completed

                    </span>

                @elseif($task->status === 'in-progress')

                    <span class="badge bg-primary fs-6">

                        <i class="fa-solid fa-spinner me-1"></i>
                        In Progress

                    </span>

                @else

                    <span class="badge bg-warning text-dark fs-6">

                        <i class="fa-solid fa-clock me-1"></i>
                        Pending

                    </span>

                @endif

            </div>

            <div class="card-body p-4">

                <h3 class="fw-bold mb-3">
                    {{ $task->title }}
                </h3>

                @if($task->description)

                    <p class="text-muted mb-4">
                        {{ $task->description }}
                    </p>

                @else

                    <p class="text-muted fst-italic mb-4">

                        <i class="fa-solid fa-circle-info me-1"></i>
                        No description provided.

                    </p>

                @endif

                <div class="row g-3 mb-4">

                    <div class="col-sm-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">

                                <i class="fa-solid fa-calendar-plus me-1"></i>
                                Start Date

                            </small>

                            <span class="fw-semibold">

                                {{ $task->start_date->format('M d, Y') }}

                            </span>

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="p-3 rounded {{ $task->isOverdue() ? 'bg-danger bg-opacity-10' : 'bg-light' }}">

                            <small class="text-muted d-block">

                                <i class="fa-solid fa-calendar-check me-1"></i>
                                Due Date

                            </small>

                            <span class="fw-semibold {{ $task->isOverdue() ? 'text-danger' : '' }}">

                                {{ $task->due_date->format('M d, Y') }}

                                @if($task->isOverdue())

                                    <i class="fa-solid fa-triangle-exclamation ms-1"></i>
                                    Overdue

                                @endif

                            </span>

                        </div>

                    </div>

                    @if($task->completed_at)

                    <div class="col-sm-6">

                        <div class="p-3 bg-success bg-opacity-10 rounded">

                            <small class="text-muted d-block">

                                <i class="fa-solid fa-circle-check me-1"></i>
                                Completed At

                            </small>

                            <span class="fw-semibold text-success">

                                {{ $task->completed_at->format('M d, Y h:i A') }}

                            </span>

                        </div>

                    </div>

                    @endif

                    <div class="col-sm-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">

                                <i class="fa-solid fa-clock me-1"></i>
                                Created

                            </small>

                            <span class="fw-semibold">

                                {{ $task->created_at->format('M d, Y') }}

                            </span>

                        </div>

                    </div>

                </div>

                <div class="d-flex flex-wrap gap-2">

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="btn btn-primary">

                        <i class="fa-solid fa-pen-to-square me-1"></i>
                        Edit Task

                    </a>

                    @if($task->status !== 'completed')

                        <form method="POST"
                              action="{{ route('tasks.complete', $task) }}">

                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-success">

                                <i class="fa-solid fa-check me-1"></i>
                                Mark as Complete

                            </button>

                        </form>

                    @endif

                    <form method="POST"
                          action="{{ route('tasks.destroy', $task) }}"
                          onsubmit="return confirm('Are you sure you want to delete this task?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-outline-danger">

                            <i class="fa-solid fa-trash me-1"></i>
                            Delete Task

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection