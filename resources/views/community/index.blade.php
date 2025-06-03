@extends('layouts.dashboardapplicant')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action btn btn-primary mb-2 text-center"
                   data-bs-toggle="modal" data-bs-target="#askQuestionModal">
                    Ajukan pertanyaan
                </a>
                <a href="{{ route('community.index', ['tab' => 'liked']) }}" class="list-group-item list-group-item-action text-center">
                    Komentar disukai
                </a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-9">
            @if(request('tab') === 'liked')
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('community.index') }}" class="btn btn-sm btn-secondary me-2">
                        &larr; Back
                    </a>
                    <h2 class="mb-0">Komentar yang Disukai</h2>
                </div>
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
            @else
                <h2>Diunggulkan</h2>
                <div class="list-group">
                    @foreach($messages as $msg)
                        <div class="list-group-item mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width:36px;height:36px;">
                                    {{ strtoupper(substr($msg->user->name,0,1)) }}
                                </div>
                                <div class="ms-2">
                                    <strong>{{ $msg->user->name }}</strong>
                                    <span class="text-muted small">· {{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="mb-2">{{ $msg->message }}</div>
                            <form action="{{ route('community.like', $msg->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $msg->isLikedBy(auth()->user()) ? 'btn-primary' : 'btn-outline-primary' }}">
                                    <i class="fas fa-thumbs-up"></i>
                                    {{ $msg->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }} ({{ is_countable($msg->likes) ? $msg->likes->count() : $msg->likes }})
                                </button>
                            </form>
                            <!-- Komentar -->
                            <div class="mt-2 ms-3">
                                <form action="{{ route('community.comment.store', $msg->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <textarea name="comment" class="form-control form-control-sm mb-1" rows="1" placeholder="Tulis komentar..."></textarea>
                                    <button class="btn btn-primary btn-sm">Kirim</button>
                                </form>
                                @foreach($msg->comments as $comment)
                                    <div class="mb-1">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        <div>{{ $comment->comment }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Ajukan Pertanyaan -->
<div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('community.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="askQuestionModalLabel">Ajukan pertanyaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width:36px;height:36px;">
              {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <div class="ms-2">
              <strong>{{ auth()->user()->name }}</strong>
              <span class="text-muted small">· Now</span>
            </div>
          </div>
          <div class="mb-3">
            <textarea name="message" class="form-control" rows="4" maxlength="500" placeholder="Apa yang ingin kamu tanyakan atau bagikan dengan komunitas ini?" required></textarea>
            <div class="text-end small mt-1"><span id="charCount">0</span>/500</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Berikut</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- End Modal -->
@endsection