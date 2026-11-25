@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Melden sie sich an oder erstellen sie ein neues Konto</h1>

<div class='login-page'>
    <fieldset class="login-page-fieldset">
        <legend>Login</legend>
        <form action="/login" method="POST">
            @csrf
            <input name="loginEmail" type="email" placeholder="E-Mail">
            <br>
            <input name="loginPassword" type="password" placeholder="Passwort">
            <hr>
            <button type="submit">Einloggen</button>
        </form>
    </fieldset>

    <fieldset class="login-page-fieldset">
        <legend>Registrieren</legend>
        <form action="/register" method="POST">
            <input name="name" type="text" placeholder="Name">
            <br>
            <input name="email" type="email" placeholder="E-Mail">
            <br>
            <input name="password" type="password" placeholder="Passwort">
            <hr>
            <button type="submit">Registrieren</button>
        </form>
    </fieldset>

</div>


@endsection
