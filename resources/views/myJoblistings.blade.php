@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Meine Stellenanzeigen</h1>

<fieldset>
    <legend>Neue Stellenanzeige erstellen</legend>

    <form action="/createJoblisting" method="POST">
        @csrf

        <label>Titel</label>
        <input name="title" type="text" value="{{ old('title') }}" required>

        <label>Beschreibung</label>
        <textarea name="description" required>{{ old('description') }}</textarea>

        <label>Standort</label>
        <input name="location" type="text" value="{{ old('location') }}" required>

        <label>Beschäftigungsart</label>
        <select name="employment_type" required>
            <option value="Fulltime">Vollzeit</option>
            <option value="Parttime">Teilzeit</option>
        </select>

        <label>Ablaufdatum</label>
        <input name="expires_at" type="date" value="{{ old('expires_at') }}" required>

        <button type="submit">Stellenanzeige erstellen</button>
    </form>
</fieldset>

<fieldset>
    <legend>Meine Anzeigen</legend>

    @forelse ($jobListings as $job)

        <fieldset>
            <legend>{{ $job->title }}</legend>

            <p>Beschreibung: {{ $job->description }}</p>
            <p>Standort: {{ $job->location }}</p>
            <p>Beschäftigungsart: {{ $job->employment_type }}</p>
            <p>Ablaufdatum: {{ $job->expires_at }}</p>

            <p>
                Status:
                @if ($job->is_published)
                    Veröffentlicht
                @else
                    Nicht veröffentlicht
                @endif
            </p>

            <form action="/jobListing/{{ $job->id }}/togglePublish" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit">
                    {{ $job->is_published ? 'Veröffentlichung ausschalten' : 'Veröffentlichen' }}
                </button>
            </form>

        </fieldset>

    @empty
        <p>Du hast noch keine Stellenanzeigen erstellt.</p>
    @endforelse

</fieldset>


@endsection
