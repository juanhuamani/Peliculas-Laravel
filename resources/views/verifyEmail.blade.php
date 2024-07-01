<x-app-layout title="Verify">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Welcome to PrimeVideo!</h1>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="content__image">
                <img src="https://ds9xi3hub5xxi.cloudfront.net/cdn/farfuture/otEn1mSO8Tk3mLVPFxYMCMwRn-qtie_ueonsviYMy0w/mtime:1608563955/sites/default/files/nodeicon/plugins_email-verification-plugin.png" alt="ImageVerify">
            </div>
            <div class="content__text">
                <h1>Hi {{$username}}</h1>
                <p>Thank you for registering an account with PrimeVideo. You're the coolest person in all the land.</p>
                <p>Before we get started, we'll need to verify your email.</p>
            </div>
            <div class="content__button">
                <a href="{{ route('verify-email', ['token' => $token]) }}" class="button">Verify Email</a>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
        </div>
    </div>
</x-app-layout>