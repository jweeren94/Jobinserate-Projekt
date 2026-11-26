<header>
    <nav class='site-nav'>
        <div class='nav-left'>
        <a href="/">Jobbörse</a>
        </div>

        <div class='nav-right'>
        @guest
            <a href="/loginRegister">Einloggen oder Registrieren</a>

        @endguest

        @auth
            @if (Auth::user()->company)
                <a href="/myJoblistings">Meine Stellenanzeigen</a>
            @endif

            <a href="/konto">Mein Konto</a>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
        </div>
    </nav>
</header>
