@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rating dan Review</h1>
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select class="form-select" id="rating" name="rating" required>
                <option value="" disabled selected>Pilih Rating</option>
                <option value="1">1 - Sangat Buruk</option>
                <option value="2">2 - Buruk</option>
                <option value="3">3 - Cukup</option>
                <option value="4">4 - Baik</option>
                <option value="5">5 - Sangat Baik</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="review" rows="4" placeholder="Tulis review Anda..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection