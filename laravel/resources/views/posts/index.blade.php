<x-layout>
    @auth
        <h1>Logged in user Home page</h1>
    @endauth
    @guest
        <h1>Guest user Home page</h1>
    @endguest
</x-layout>
