@extends('layouts.app')
@section('title', 'Edit Task')

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

                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>
                Edit Task

            </h2>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form method="POST"
                      action="{{ route('tasks.update', $task) }}">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-pen me-1"></i>
                                Task Title

                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}"
                                   placeholder="e.g. Morning Run 5km">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-align-left me-1"></i>
                                Description

                            </label>

                            <textarea name="description"
                                      rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Add details about this task...">{{ old('description', $task->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-layer-group me-1"></i>
                                Category

                                <span class="text-danger">*</span>

                            </label>

                            <select name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">

                                <option value="">
                                    Select category...
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>

                                        <i class="{{ $task->category->icon }}"></i>
                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-flag me-1"></i>
                                Priority

                                <span class="text-danger">*</span>

                            </label>

                            <select name="priority"
                                    class="form-select @error('priority') is-invalid @enderror">

                                <option value="low"
                                    {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>

                                    Low

                                </option>

                                <option value="medium"
                                    {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>

                                    Medium

                                </option>

                                <option value="high"
                                    {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>

                                    High

                                </option>

                            </select>

                            @error('priority')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-bars-progress me-1"></i>
                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="pending"
                                    {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>

                                    Pending

                                </option>

                                <option value="in-progress"
                                    {{ old('status', $task->status) === 'in-progress' ? 'selected' : '' }}>

                                    In Progress

                                </option>

                                <option value="completed"
                                    {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>

                                    Completed

                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-calendar-plus me-1"></i>
                                Start Date

                                <span class="text-danger">*</span>

                            </label>

                            <input type="date"
                                   name="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror"
                                   value="{{ old('start_date', $task->start_date->format('Y-m-d')) }}">

                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                <i class="fa-solid fa-calendar-check me-1"></i>
                                Due Date

                                <span class="text-danger">*</span>

                            </label>

                            <input type="date"
                                   name="due_date"
                                   class="form-control @error('due_date') is-invalid @enderror"
                                   value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}">

                            @error('due_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-12 d-flex gap-2 mt-2">

                            <button type="submit"
                                    class="btn btn-primary px-4">

                                <i class="fa-solid fa-floppy-disk me-1"></i>
                                Update Task

                            </button>

                            <a href="{{ route('tasks.show', $task) }}"
                               class="btn btn-outline-secondary">

                                <i class="fa-solid fa-xmark me-1"></i>
                                Cancel

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection