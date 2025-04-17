<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JobMatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Optional: tambahkan CSS eksternal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .chat-box {
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            background: #f8f9fa;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-message.user {
            text-align: right;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
        }

        .chat-message {
            border-radius: 15px;
            padding: 10px 15px;
            margin-bottom: 10px;
        }

        .bg-secondary-subtle {
            background-color: #5a7c80 !important;
            color: white;
        }

        .bg-dark-green {
            background-color: #2B4251;
            color: white;
        }
        input::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
