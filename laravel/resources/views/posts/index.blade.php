<x-layout>
    @auth
        <h1 class="title">Latest posts</h1>
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <x-postcard :post="$post"/>
            @endforeach
        </div>
        <div>
            {{$posts->links()}}
        </div>
    @endauth
    @guest
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postcard :post="$post"/>
        @endforeach
    </div>
    <div>
        {{$posts->links()}}
    </div>
    @endguest
</x-layout>
