<x-layout>
    <h1>Email Verification</h1>
    <p>Hey  {{ auth()->user()->username}},
        Thank you for joining {{ env('APP_NAME') }}! To activate your account and start exploring, please click the verification link we've sent to your inbox
        Best Regards,
        {{ env('APP_NAME') }} Team
    </p>
    <br>
    <p>Didn't get the email?</p>
    <form action="{{ route('verification.send')}}" method="post">
        @csrf
        <button class="btn">Resend</button>
    </form>
    
</x-layout>