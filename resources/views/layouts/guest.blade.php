<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Habitat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if ($errors->any())
        <div class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; width: 90%; max-width: 500px;">
            <div class="alert alert-danger mb-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @yield('content')
</body>
</html>
