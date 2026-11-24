<header>
    <nav>
        <a href="/">Jobbörse</a>
        <a href="/jobs">Stellenanzeigen</a>

        @guest
            <a href="/login">Login</a>
            <a href="/register">Registrieren</a>
        @endguest

        @auth
            <a href="/dashboard">Mein Konto</a>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>
</header>
