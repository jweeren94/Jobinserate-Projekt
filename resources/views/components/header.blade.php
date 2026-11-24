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
            <a href="/dashboard">Mein Konto</a>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
        </div>
    </nav>
</header>
