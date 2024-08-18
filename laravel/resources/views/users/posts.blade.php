<x-layout>
    <h1 class="title">{{$username}}'s Posts</h1>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postcard :post="$post"/>
        @endforeach
    </div>
    <div>
        {{$posts->links()}}
    </div>
    <p>Total posts: {{$posts->total()}}</p>
</x-layout>