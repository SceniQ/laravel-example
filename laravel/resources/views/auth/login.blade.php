<x-layout>
    <h1 class="title">Welcome back!</h1>
    <div class="mx-auto max-w.screen-sm card">
        @if (session('status'))
                <x-flashmsg msg="{{session('status')}}"/>
        @endif

        <form action="{{ route('login')}}" method="POST">
            @csrf
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email')}}" 
                class="input @error('email') ring-red-500" @enderror">
                @error('email')
                   <p class="error">{{ $message }}</p> 
                @enderror
            </div>
            {{-- Password --}}
            <div class="mb-8">
                <label for="password">Password</label>
                <input type="password" name="password" class="input @error('password') ring-red-500" @enderror">
                @error('password')
                   <p class="error">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Remember me checkbox --}}
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="{{route('password.request')}}" class="block mb-2 text-xs text-blue-500">Forgot password?</a>
            </div>

            @error('failed')
                <p class="error"> {{ $message}}</p>
            @enderror
            {{-- Submit btn --}}
            <button class="primary-btn">Login</button>

        </form>

    </div>
</x-layout>
