
@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Willkommen auf der Jobbörse</h1>

<fieldset class="job-search">
    <legend>Finden Sie Ihre ideale Stelle!</legend>

    <form action="/" method="GET">
        <label for="location">Stadt</label>
        <input
            type="text"
            id="location"
            name="location"
            placeholder="Stadt eingeben"
            value="{{ request('location') }}"
        >

        <label for="employment_type">Beschäftigungsart</label>
        <select name="employment_type" id="employment_type">
            <option value="">Alle Beschäftigungsarten</option>
            <option value="Fulltime" @selected(request('employment_type') == 'Fulltime')>
                Vollzeit
            </option>
            <option value="Parttime" @selected(request('employment_type') == 'Parttime')>
                Teilzeit
            </option>
        </select>

        <button type="submit">Suchen</button>
    </form>
</fieldset>

<fieldset class="job-listings">
    <legend>Neueste Stellenangebote</legend>

    @forelse ($jobListings as $jobListing)
        <article class="job-card">
            <h3>{{ $jobListing->title }}</h3>

            <p>
                <strong>Firma:</strong>
                {{ $jobListing->company->name }}
            </p>

            <p>
                <strong>Stadt:</strong>
                {{ $jobListing->location }}
            </p>

            <p>
                <strong>Beschäftigungsart:</strong>
                {{ $jobListing->employment_type == 'Fulltime' ? 'Vollzeit' : 'Teilzeit' }}
            </p>

            <a href="{{ route('jobListings.show', $jobListing) }}">
                <button type="button">Details ansehen</button>
            </a>
        </article>
    @empty
        <p>Es wurden keine passenden Stellenangebote gefunden.</p>
    @endforelse
</fieldset>

@endsection
