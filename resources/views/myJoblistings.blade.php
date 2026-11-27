@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<h1>Meine Stellenanzeigen</h1>

<fieldset>
    <legend>Neue Stellenanzeige erstellen</legend>

    <form action="/createJobListing" method="POST">
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

        {{-- Normale Ansicht --}}
        <div id="display-{{ $job->id }}">
            <p>Beschreibung: {{ $job->description }}</p>
            <p>Standort: {{ $job->location }}</p>
            <p>Beschäftigungsart: {{ $job->employment_type }}</p>
            <p>Ablaufdatum: {{ $job->expires_at->format('d.m.Y') }}</p>

            <p>
                Status:
                @if ($job->is_published)
                    Veröffentlicht
                @else
                    Nicht veröffentlicht
                @endif
            </p>

            <button type="button" onclick="toggleEdit({{ $job->id }})">
                Bearbeiten
            </button>
        </div>

        {{-- Bearbeitungsansicht --}}
        <div id="edit-{{ $job->id }}" hidden>
            <form action="/jobListing/{{ $job->id }}" method="POST">
                @csrf
                @method('PATCH')

                <label>Titel</label>
                <input name="title" type="text" value="{{ $job->title }}" required>

                <label>Beschreibung</label>
                <textarea name="description" required>{{ $job->description }}</textarea>

                <label>Standort</label>
                <input name="location" type="text" value="{{ $job->location }}" required>

                <label>Beschäftigungsart</label>
                <select name="employment_type" required>
                    <option value="Fulltime" {{ $job->employment_type == 'Fulltime' ? 'selected' : '' }}>
                        Vollzeit
                    </option>
                    <option value="Parttime" {{ $job->employment_type == 'Parttime' ? 'selected' : '' }}>
                        Teilzeit
                    </option>
                </select>

                <label>Ablaufdatum</label>
                <input
                    name="expires_at"
                    type="date"
                    value="{{ $job->expires_at->format('Y-m-d') }}"
                    required
                >

                <button type="submit">Änderungen speichern</button>

                <button type="button" onclick="toggleEdit({{ $job->id }})">
                    Abbrechen
                </button>
            </form>
        </div>

        {{-- Veröffentlichung umschalten --}}
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

<script>
    function toggleEdit(id) {
        const display = document.getElementById('display-' + id);
        const edit = document.getElementById('edit-' + id);

        display.hidden = !display.hidden;
        edit.hidden = !edit.hidden;
    }
</script>

@endsection
