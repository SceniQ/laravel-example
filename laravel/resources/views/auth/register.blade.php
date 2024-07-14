<x-layout>
    <h1 class="title">Registration</h1>
    <div class="mx-auto max-w.screen-sm card">

        <form action="{{ route('register')}}" method="POST">
            @csrf
            {{-- Username --}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" name="username" class="input">
            </div>
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" class="input">
            </div>
            {{-- Password --}}
            <div class="mb-8">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
            </div>
            {{-- Password confirmation --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="input">
            </div>

            {{-- Submit btn --}}
            <button class="btn">Register</button>

        </form>

    </div>
</x-layout>
