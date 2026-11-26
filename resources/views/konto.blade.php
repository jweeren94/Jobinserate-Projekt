@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Mein Konto</h1>

<fieldset>
    <legend>Kontodaten</legend>

    <form action="/updateUser" method="POST">
        @csrf
        @method('PUT')

        <label>Name</label>
        <input name="name" type="text"
            value="{{ old('name', Auth::user()->name) }}">

        <label>E-Mail</label>
        <input name="email" type="email"
            value="{{ old('email', Auth::user()->email) }}">
        <hr>
        <button type="submit">Kontodaten speichern</button>
    </form>
</fieldset>

<fieldset>
    <legend>Firma</legend>

    @if (Auth::user()->company)

        <form action="/updateCompany" method="POST">
            @csrf
            @method('PUT')

            <label>Firmenname</label>
            <input name="name" type="text"
                value="{{ old('name', Auth::user()->company->name) }}">

            <label>Beschreibung</label>
            <textarea name="description">{{ old('description', Auth::user()->company->description) }}</textarea>

            <label>Stadt</label>
            <input name="city" type="text"
                value="{{ old('city', Auth::user()->company->city) }}">

            <label>Webseite</label>
            <input name="website" type="text"
                value="{{ old('website', Auth::user()->company->website) }}">

            <label>Kontakt-E-Mail</label>
            <input name="contact_email" type="email"
                value="{{ old('contact_email', Auth::user()->company->contact_email) }}">
            <hr>
            <button type="submit">Firmendaten speichern</button>
        </form>

    @else

        <p>Wenn Sie eine Firma haben, können Sie diese hier registrieren, um Stellenanzeigen zu veröffentlichen.</p>

        <hr>

        <form action="/createCompany" method="POST">
            @csrf

            <input name="name" type="text" placeholder="Name">
            <input name="description" type="text" placeholder="Beschreibung">
            <input name="city" type="text" placeholder="Stadt">
            <input name="website" type="text" placeholder="Webseite">
            <input name="contact_email" type="email" placeholder="Kontakt-E-Mail">
            <hr>
            <button type="submit">Firma registrieren</button>
        </form>

    @endif
</fieldset>









@endsection
