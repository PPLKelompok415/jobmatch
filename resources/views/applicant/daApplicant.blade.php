
  <header class="topbar">
    <div><strong>🧊 JOBMATCH</strong></div>
    <div>🌐 Language &nbsp;&nbsp; | &nbsp;&nbsp; Employer site &nbsp;&nbsp; <img src="https://via.placeholder.com/30" alt="Profile" style="border-radius: 50%;" /></div>
  </header>

  <nav class="menu">
    <div>Bookmark</div>
    <div>Community</div>
    <div>Notification & Announcement</div>
  </nav>

  <div class="content">
    <div class="title">MATCH</div>
    <div class="subtitle">{{ count($matchingJobs) }} companies</div>

    <!-- Jika ada pekerjaan yang cocok, tampilkan -->
    @if($matchingJobs->isNotEmpty())
        <div class="card-container">
            @foreach($matchingJobs as $job)
                <div class="card">
                    <div class="company-logo">
                        <img src="{{ $job->company->logo }}" alt="{{ $job->company->company_name }}">
                    </div>
                    <div class="job-info">
                        <h4>{{ $job->company->company_name }}</h4>
                        <p><strong>{{ $job->position }}</strong></p>
                        <div class="meta">
                            📍 {{ $job->location }} &nbsp;&nbsp; 🕒 {{ $job->deadline }} &nbsp;&nbsp; 🕐 {{ $job->type_of_work }}
                        </div>
                    </div>
                    <div class="match-score">{{ $job->match_score }}%</div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Tampilkan No Match jika tidak ada pekerjaan yang cocok -->
        <div class="no-match-box">
            <i>🗂️</i>
            <strong>No Match</strong>
        </div>
    @endif

    <!-- Pekerjaan yang tidak cocok akan ditampilkan hanya jika ada pekerjaan yang cocok -->
    @if($matchingJobs->isNotEmpty() && $noMatchingJobs->isNotEmpty())
        <div class="subtitle">No match jobs:</div>
        <div class="card-container">
            @foreach($noMatchingJobs as $job)
                <div class="card">
                    <div class="company-logo">
                        <img src="{{ $job->company->logo }}" alt="{{ $job->company->company_name }}">
                    </div>
                    <div class="job-info">
                        <h4>{{ $job->company->company_name }}</h4>
                        <p><strong>{{ $job->position }}</strong></p>
                        <div class="meta">
                            📍 {{ $job->location }} &nbsp;&nbsp; 🕒 {{ $job->deadline }} &nbsp;&nbsp; 🕐 {{ $job->type_of_work }}
                        </div>
                    </div>
                    <div class="match-score">{{ $job->match_score }}%</div>
                </div>
            @endforeach
        </div>
    @endif
  </div>

  <footer>
    <div>Terms & Conditions</div>
    <div>Security & Privacy</div>
    <div>Help Centre</div>
  </footer>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f7f7f7;
    }

    header, footer {
      display: flex;
      justify-content: space-between;
      padding: 1rem 2rem;
      font-size: 14px;
      background-color: #fff;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .menu {
      display: flex;
      gap: 40px;
      font-size: 12px;
      margin: 0 2rem;
      border-bottom: 1px solid #000;
      padding: 10px 0 8px;
      background-color: #fff;
    }

    .content {
      text-align: center;
      margin-top: 60px;
    }

    .title {
      font-size: 28px;
      font-weight: bold;
      color: #2e3e4e;
    }

    .subtitle {
      font-size: 10px;
      color: #777;
      margin-bottom: 40px;
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Membuat grid responsif */
      gap: 20px;
      max-width: 1000px; /* Maksimal lebar grid */
      margin: 0 auto; /* Center the grid */
    }

    .card {
      background-color: #bcc7cf;
      border-radius: 10px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
      min-width: 250px;  /* Menambahkan lebar minimal */
      max-width: 400px;  /* Menambahkan lebar maksimal */
      height: 120px;  /* Sesuaikan dengan tinggi card */
      overflow: hidden; /* Agar tidak ada elemen yang tumpah */
    }

    .company-logo img {
      max-width: 100%; /* Agar gambar tidak melebar */
      height: auto;    /* Menjaga proporsi gambar */
      max-height: 60px; /* Menentukan tinggi gambar */
      object-fit: contain; /* Menjaga gambar agar proporsional */
    }

    .job-info {
      flex-grow: 1;
      text-align: left;
    }

    .job-info h4 {
      margin: 0;
      font-size: 12px;
      font-weight: bold;
    }

    .job-info p {
      margin: 4px 0;
      font-size: 10px;
      color: #333;
    }

    .meta {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 9px;
    }

    .match-score {
      font-weight: bold;
      font-size: 16px;
      color: #2e3e4e;
    }

    footer {
      font-size: 10px;
      justify-content: center;
      gap: 40px;
      margin-top: 80px;
      border-top: 1px solid #000;
      padding: 20px 0;
      background-color: #fff;
    }

    .no-match-box {
      width: 650px;
      margin: 0 auto;
      background-color: #bcc7cf;
      padding: 100px;
      border-radius: 10px;
      color: #2e3e4e;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .no-match-box i {
      font-size: 40px;
      margin-bottom: 10px;
    }

    .no-match-box strong {
      font-size: 14px;
    }
  </style>

