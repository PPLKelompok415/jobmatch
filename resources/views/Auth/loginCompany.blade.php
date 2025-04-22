@extends('layouts.app')

@section('content')
    <div class="container text-center my-5 pt-5">
        <!-- Form Login -->
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="{{ route('company.login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
