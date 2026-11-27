
@extends('layouts.app')

@section('title', $jobListing->title)

@section('content')

<h1>{{ $jobListing->title }}</h1>

<fieldset class="company-details">
    <legend>Über das Unternehmen</legend>

    <h2>{{ $jobListing->company->name }}</h2>

    <p>
        {{ $jobListing->company->description }}
    </p>

    <p>
        <strong>Standort:</strong>
        {{ $jobListing->company->city }}
    </p>

    <p>
        <strong>Kontakt-E-Mail:</strong>
        <a href="mailto:{{ $jobListing->company->contact_email }}">
            {{ $jobListing->company->contact_email }}
        </a>
    </p>

    @if ($jobListing->company->website)
        <p>
            <strong>Website:</strong>
            <a href="{{ $jobListing->company->website }}" target="_blank">
                {{ $jobListing->company->website }}
            </a>
        </p>
    @endif
</fieldset>

<fieldset class="job-details">
    <legend>Stellenausschreibung</legend>

    <h2>{{ $jobListing->title }}</h2>

    <p>
        <strong>Standort:</strong>
        {{ $jobListing->location }}
    </p>

    <p>
        <strong>Beschäftigungsart:</strong>
        {{ $jobListing->employment_type == 'Fulltime' ? 'Vollzeit' : 'Teilzeit' }}
    </p>

    <p>
        <strong>Veröffentlicht am:</strong>
        {{ $jobListing->created_at->format('d.m.Y') }}
    </p>

    <p>
        <strong>Bewerbung möglich bis:</strong>
        {{ $jobListing->expires_at }}
    </p>

    <hr>

    <h3>Beschreibung</h3>

    <p>{{ $jobListing->description }}</p>
</fieldset>

<a href="/">Zurück zur Übersicht</a>

@endsection
