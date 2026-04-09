<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Student Habitat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Student Habitat</a>

        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="{{ route('cities.public') }}" class="nav-link">Cities</a></li>
                <li class="nav-item"><a href="{{ route('experiences.index') }}" class="nav-link">Experiences</a></li>
                <li class="nav-item"><a href="{{ route('questions.index') }}" class="nav-link">Questions</a></li>

                @auth
                    @if(auth()->user()?->is_admin)
                        <li class="nav-item"><a href="{{ route('countries.index') }}" class="nav-link">Manage Countries</a></li>
                        <li class="nav-item"><a href="{{ route('admin.cities.index') }}" class="nav-link">Manage Cities</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item"><span class="nav-link">Hi, {{ auth()->user()?->name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-light btn-sm mt-1">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>