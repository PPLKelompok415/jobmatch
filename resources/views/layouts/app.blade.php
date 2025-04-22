<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobMatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Optional: tambahkan CSS & Bootstrap eksternal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @yield('styles')
</head>
<body>
    <!-- Navbar Fixed di atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">JOBMATCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Language</a>
                    </li>
                    <!-- Check if the current URL is for the login applicant page -->
                    @if (url()->current() == url('/login/applicant'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Applicant Site</a>
                        </li>
                    @elseif (url()->current() == url('/Company'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Applicant Site</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('CompanyHome') }}">Company site</a>
                        </li>
                    @endif
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <!-- Check if we are on Company URL or Applicant URL -->
                        @if (url()->current() == url('/Company'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.company') }}">Login</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.applicant') }}">Login</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        @yield('content')
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
