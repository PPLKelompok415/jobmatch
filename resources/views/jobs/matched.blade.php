@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Job Match Results for {{ $applicant->name }}</h2>

        {{-- Livewire component --}}
        <livewire:job-matching-component :applicant-id="$applicant->id" />
    </div>
@endsection