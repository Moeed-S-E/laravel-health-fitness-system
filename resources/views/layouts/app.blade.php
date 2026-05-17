<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HealthTrack — @yield('title', 'Dashboard')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

    {{-- Optional Laravel CSS --}}
    @vite(['resources/css/app.css'])

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-heart-pulse me-2"></i>
            HealthTrack
        </a>


        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">

                        <i class="fa-solid fa-house me-1"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}"
                       href="{{ route('tasks.index') }}">

                        <i class="fa-solid fa-list-check me-1"></i>
                        My Tasks
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('tasks.create') }}">

                        <i class="fa-solid fa-plus me-1"></i>
                        New Task
                    </a>
                </li>

            </ul>


            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <i class="fa-solid fa-user me-1"></i>
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

    <li>
        <span class="dropdown-item-text text-muted small">
            {{ Auth::user()->email }}
        </span>
    </li>

    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="fa-solid fa-user-gear me-2"></i>
            Profile Settings
        </a>
    </li>

    <li><hr class="dropdown-divider"></li>

    <li>
        <button type="button"
                class="dropdown-item text-danger"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal">

            <i class="fa-solid fa-right-from-bracket me-2"></i>
            Logout
        </button>
    </li>

</ul>

                </li>

            </ul>

        </div>
    </div>
</nav>


<div class="modal fade"
     id="logoutModal"
     tabindex="-1"
     aria-labelledby="logoutModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title" id="logoutModalLabel">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Confirm Logout
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center py-4">

                <i class="fa-solid fa-circle-question text-danger fa-3x mb-3"></i>

                <p class="fs-5 mb-1">
                    Are you sure you want to logout?
                </p>

                <p class="text-muted small">
                    You will need to login again to access your account.
                </p>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">

                <button type="button"
                        class="btn btn-secondary px-4"
                        data-bs-dismiss="modal">

                    <i class="fa-solid fa-xmark me-1"></i>
                    Cancel
                </button>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="btn btn-danger px-4">

                        <i class="fa-solid fa-right-from-bracket me-1"></i>
                        Yes, Logout
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

{{-- PAGE CONTENT --}}
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    @yield('content')

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>