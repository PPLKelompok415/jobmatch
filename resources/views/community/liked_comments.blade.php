@extends('layouts.dashboardapplicant')

@section('content')
<div class="container">
    <h2>Komentar yang Disukai</h2>
    <ul class="list-group">
        @forelse($likedComments as $like)
            <li class="list-group-item">
                <strong>{{ $like->community->user->name ?? '-' }}</strong>:
                {{ $like->community->message ?? '-' }}
                <br>
                <small class="text-muted">Disukai pada {{ $like->created_at->diffForHumans() }}</small>
            </li>
        @empty
            <li class="list-group-item">Belum ada komentar yang disukai.</li>
        @endforelse
    </ul>
</div>
@endsection