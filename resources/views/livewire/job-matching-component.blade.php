<div>
    <button class="btn btn-primary mb-3" wire:click="match" wire:loading.attr="disabled">
        Cari Pekerjaan Cocok
    </button>

    <div wire:loading>
        <div class="alert alert-info">Sedang mencocokkan pekerjaan...</div>
    </div>

    @if ($matchedJobs)
        @foreach ($matchedJobs as $job)
            <div class="card mb-2">
                <div class="card-body">
                    <h5>{{ $job['title'] }}</h5>
                    <p class="mb-0"><strong>Lokasi:</strong> {{ $job['location'] }}</p>
                    <p class="mb-0"><strong>Type:</strong> {{ $job['type_of_work'] }}</p>
                    <p class="mb-0"><strong>Gaji:</strong> {{ $job['gaji_min'] }} - {{ $job['gaji_max'] }}</p>
                    <p class="mb-0"><strong>Score:</strong> {{ $job['match_score'] }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
