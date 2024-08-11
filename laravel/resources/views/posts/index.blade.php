<x-layout>
    @auth
        <h1 class="title">Latest posts for your timeline, {{ auth()->user()->username}}</h1>
    @endauth
    @guest
        <h1>Guest user Home page</h1>
    @endguest
</x-layout>
