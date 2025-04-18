@extends('layouts.app')

@section('content')
    <div class="container text-center my-5">
        <!-- Logo
        <div>
            <img src="https://via.placeholder.com/150" alt="JobMatch Logo" class="img-fluid mb-3" />
        </div> -->

        <!-- Main Title -->
        <h1 class="display-3 font-weight-bold mb-4">MATCH</h1>
        <h2 class="display-4 font-weight-light mb-4">WORK</h2>
        <h3 class="display-5 font-weight-light mb-5">GROW</h3>

        <!-- Subheading -->
        <p class="lead mb-5">Match with the right job for you!</p>

        <!-- Register & Login Buttons -->
        <div>
        <a href="{{ route('register.applicant') }}" class="btn btn-primary btn-lg mx-2">REGISTER</a>
        <a href="{{ route('login.applicant') }}" class="btn btn-secondary btn-lg mx-2">LOGIN</a>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #fff;
            font-family: 'Arial', sans-serif;
        }

        h1, h2, h3 {
            color: #1A2A33; /* Warna biru gelap sesuai dengan desain */
        }

        .btn {
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 18px;
            font-weight: 600;
        }

        .lead {
            color: #666;
        }

        .container {
            max-width: 1500px;
            margin-top: 10px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f5f5f5;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-body {
            padding: 40px;
        }
    </style>
@endsection
