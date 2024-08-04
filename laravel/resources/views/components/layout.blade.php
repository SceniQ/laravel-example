<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Comaptible" content="ie=edge" />
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources\css\app.css','laravel\resources\js\app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

</head>

<body class="bg-slate-100 text-slate-900">
    <header>
        <nav>
            <a href="{{route('home')}}" class="nav-link">Home</a>
            @auth
                <div class="relative grid place-items-center" x-data="{ open: false}">
                    {{-- Dropdown menu --}}
                    <button type="button" class="round-btn" @click="open = !open">
                        <img src="https://picsum.photos/seed/picsum/200" alt="img">
                    </button>

                    {{-- Dropdown menu item(s) --}}
                    <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light">
                        <p class="username">{{auth()->user()->username}}</p>
                        <a href="{{route('dashboard')}}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
            <div>
                <a href="{{route('login')}}" class="nav-link">Login</a>
                <a href="{{route('register')}}" class="nav-link">Register</a>
            </div>
            @endguest
        </nav>
    </header>
    
    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{$slot}}
    </main>

</body>

</html>

