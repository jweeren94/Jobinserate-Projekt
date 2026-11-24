@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Melden sie sich an oder erstellen sie ein neues Konto</h1>

<div class='login-page'>
    <fieldset class="login-page-fieldset">
        <legend>Login</legend>
        <form>
            <input type="email" placeholder="E-Mail">
            <br>
            <input type="password" placeholder="Passwort">
            <hr>
            <button type="submit">Einloggen</button>
        </form>
    </fieldset>

    <fieldset class="login-page-fieldset">
        <legend>Registrieren</legend>
        <form>
            <input type="text" placeholder="Name">
            <br>
            <input type="email" placeholder="E-Mail">
            <br>
            <input type="password" placeholder="Passwort">
            <hr>
            <button type="submit">Registrieren</button>
        </form>
    </fieldset>

</div>


@endsection
