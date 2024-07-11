<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <meta http-equiv="X-UA-Comaptible" content="ie=edge" />

    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources\css\app.css','laravel\resources\js\app.js'])

</head>

<body class="bg-slate-100 text-slate-900">
    <header>
        <nav>
            <a href="{{route('home')}}" class="nav-link">Home</a>
            <div>
                <a href="{{route('login')}}" class="nav-link">Login</a>
                <a href="{{route('register')}}" class="nav-link">Register</a>
            </div>
        </nav>
    </header>
    
    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{$slot}}
    </main>

</body>

</html>

