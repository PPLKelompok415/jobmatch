@extends('layouts.app')

@section('content')
    <div class="mb-2 border-bottom pb-2 d-flex justify-content-start gap-4 small text-muted">
        <a class='btn' href="{{route('bookmark')}}">Bookmark</a>
        <a class='btn' href="#">Community</a>
        <a class='btn' href="#">Notification & Announcement</a>
    </div>

    <div class="bg-dark-green text-white rounded d-flex align-items-center p-3 mb-2" height=50%>
        <a href="/" class="text-white me-3 fs-5">&larr;</a>
        <div class="text-center flex-grow-1 fw-bold ">GOJEK</div>
        <img src="images/gojek.png" class="rounded-circle" alt="Avatar" width="40" height="40">
    </div>

    <div class="text-center text-muted small my-3">
        Thursday, 3 Jan 17:02
    </div>

    <div id="chatBox" class="mb-3 px-2" style="min-height: 300px;">
        @foreach ($messages as $msg)
            @if ($msg->sender_id === auth()->id())
                <!-- Pesan dari user (kanan) -->
                <div class="bg-secondary-subtle p-3 rounded text-black ms-auto mb-2"
                    style="max-width: 75%; background-color: #dfdfdf !important;">
                    {{ $msg->message }}
                </div>
            @else
                <!-- Pesan dari admin / perusahaan (kiri) -->
                <div class="bg-secondady-subtle p-3 rounded text-white mb-2"
                    style="max-width: 75%; background-color: #5a7c80 !important;">
                    {{ $msg->message }}
                </div>
            @endif
        @endforeach
    </div>


    <form id="chatForm" class="d-flex align-items-center border-top pt-3 mt-3" method="POST" action="{{ route('chat.send') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <span class="me-2 text-muted fs-5">🔗</span>
        <input type="text" name="message" id="chatInput" class="form-control border-0" placeholder="Message">
        <button type="submit" class="btn btn-link text-muted fs-5">Send</button>
    </form>

    <footer class="d-flex justify-content-end gap-4 small text-muted mt-4">
        <a class='btn' href="#">Terms & Conditions</a>
        <a class='btn' href="#">Security & Privacy</a>
        <a class='btn' href="#">Help Centre</a>
    </footer>

@endsection
