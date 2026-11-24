@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Willkommen auf der Jobbörse</h1>
<fieldset class="job-search">
    <legend>Finden sie ihre ideale Stelle!</legend>
    <form>
        <input type="text" placeholder="Stellenbezeichnung">
        <input type="text" placeholder="Ort">
        <button type="submit">Suchen</button>
    </form>
</fieldset>

<fieldset class="job-listings">
    <legend>Neueste Stellenangebote</legend>
</fieldset>



@endsection
