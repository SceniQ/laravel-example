<x-layout>
    <h1 class="title">Request a password reset email</h1>
    <div class="mx-auto max-w.screen-sm card">
        @if (session('status'))
                <x-flashmsg msg="{{session('status')}}"/>
        @endif
        <form action="{{ route('password.email')}}" method="POST" x-data="formSubmit" @submit.prevent="submit">
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
            {{-- Submit btn --}}
            <button class="primary-btn" x-ref="btn">Submit</button>

        </form>

    </div>
</x-layout>
