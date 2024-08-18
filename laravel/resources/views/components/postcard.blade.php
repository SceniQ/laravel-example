@props(['post'])
<div class="card">
    {{-- Title --}}
    <h1 class="font-bold text-xl"> {{$post->title}}</h1>
    {{-- Author & Date --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{$post->created_at->diffForHumans()}} by</span>
        <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{$post->user->username}}</a>
    </div>
    {{-- Body --}}
    <div class="text-sm">
        <p>{{ Str::words($post->body,15)}}</p>
    </div>
</div>