<x-layout>
    @auth
        <h1 class="title">Latest posts for your timeline, {{ auth()->user()->username}}</h1>

        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div class="card">
                    {{-- Title --}}
                    <h1 class="font-bold text-xl"> {{$post->title}}</h1>
                    {{-- Author & Date --}}
                    <div class="text-xs font-light mb-4">
                        <span>Posted {{$post->created_at->diffForHumans()}} by</span>
                        <a href="" class="text-blue-500 font-medium">username</a>
                    </div>
                    {{-- Body --}}
                    <div class="text-sm">
                        <p>{{ Str::words($post->body,15)}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endauth
    @guest
        <h1>Guest user Home page</h1>
    @endguest
</x-layout>
