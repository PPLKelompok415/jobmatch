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
        <!-- Default messages -->
        <div class="bg-secondady-subtle p-3 rounded text-white mb-2" style="max-width: 75%; background-color: #5a7c80;">
            Good Afternoon! Previously, let me introduce myself, my name is Raisa Leonore, I am glad you can match with our company...
        </div>
    </div>

    <form id="chatForm" class="d-flex align-items-center border-top pt-3 mt-3">
        <span class="me-2 text-muted fs-5">🔗</span>
        <input type="text" name="chatInput" id="chatInput" class="form-control border-0" placeholder="Message">
        <button type="submit" class="btn btn-link text-muted fs-5">Send</button>
    </form>

    <footer class="d-flex justify-content-end gap-4 small text-muted mt-4">
        <a class='btn' href="#">Terms & Conditions</a>
        <a class='btn' href="#">Security & Privacy</a>
        <a class='btn' href="#">Help Centre</a>
    </footer>

    <!-- Script -->
    <script>
        const chatForm = document.getElementById('chatForm');
        const chatInput = document.getElementById('chatInput');
        const chatBox = document.getElementById('chatBox');

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (message === '') return;

            // Create user's message bubble
            const userMsg = document.createElement('div');
            userMsg.className = 'bg-secondary-subtle p-3 rounded text-black ms-auto mb-2';
            userMsg.style.cssText = 'max-width: 75%; background-color: #dfdfdf !important;';
            userMsg.textContent = message;
            chatBox.appendChild(userMsg);

            chatInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            // Simulate admin reply (optional)
            setTimeout(() => {
                const reply = document.createElement('div');
                reply.className = 'bg-secondady-subtle p-3 rounded text-white mb-2';
                reply.style.cssText = 'max-width: 75%; background-color: #5a7c80 !important;';
                reply.textContent = "Thank you for your message. We will get back to you shortly. (System Message)";
                chatBox.appendChild(reply);
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 1000);
        });
    </script>
@endsection
