<x-layout>
        <h1 class="title">Welcome back, {{ auth()->user()->username}}</h1>
        {{-- create form --}}
        <div class="card mb-4">
                <h2 class="font-bold mb-4"> Create a post</h2>
                
                @if (session('success'))
                        <div class="mb-2">
                                <x-flashmsg msg="{{session('success')}}"/>
                        </div>

                @endif

                <form action="{{ route('posts.store')}}" method="post">
                @csrf
                {{-- Post title --}}
                <div class="mb-4">
                        <label for="title">Post title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                        class="input @error('title') ring-red-500 @enderror">
                        @error('title')
                           <p class="error">{{ $message }}</p> 
                        @enderror
                </div>
                {{-- Content --}}
                <div class="mb-4">
                        <label for="body">Content</label>
                        <textarea name="body" rows="5" 
                        class="input @error('body') ring-red-500" @enderror">{{ old('body')}}</textarea>
                        @error('body')
                           <p class="error">{{ $message }}</p> 
                        @enderror
                </div>
                {{-- Create btn --}}
                <button class="primary-btn">Create</button>

                </form>
        </div>

        {{-- Users' posts --}}
        <h2 class="font-bold mb-4">Your latest posts</h2>
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <x-postcard :post="$post"/>
            @endforeach
        </div>
        <div>
            {{$posts->links()}}
        </div>
</x-layout>