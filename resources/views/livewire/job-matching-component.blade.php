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
                    <p class="mb-0">
                        <strong>Gaji:</strong>
                        Rp{{ number_format($job['gaji_min'], 0, ',', '.') }}
                        - Rp{{ number_format($job['gaji_max'], 0, ',', '.') }}
                    </p>
                    <p class="mb-0">
                        <strong>Score:</strong>
                        <span class="badge bg-{{ $job['match_score'] >= 20 ? 'success' : ($job['match_score'] >= 10 ? 'warning' : 'secondary') }}">
                            {{ $job['match_score'] }}
                        </span>
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
