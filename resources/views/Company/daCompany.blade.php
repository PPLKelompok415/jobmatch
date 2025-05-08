
  <div class="main-container">
    <header class="header">
      <div class="logo">
        <div class="logo-icon"></div>
        <div class="logo-text">JOBMATCH</div>
      </div>
      <div class="nav">
        🌐 Language &nbsp;&nbsp; | &nbsp;&nbsp; Applicant site &nbsp;&nbsp; <img src="https://img.icons8.com/fluency/48/000000/user-male-circle.png" />
      </div>
    </header>

    <!-- Breadcrumb - Ganti Employer Dashboard menjadi Community -->
    <div class="breadcrumb">
      <a href="{{ route('applicant.dashboard') }}" style="text-decoration: none; color: #333;">Community</a>
    </div>

    <div class="title-section">
      <h1>MATCH</h1>
      <small>{{ count($matchingJobs) }} applicants</small>
    </div>

    <!-- Jika ada pekerjaan yang cocok, tampilkan -->
    @if($matchingJobs->isNotEmpty())
      <div class="grid">
        @foreach($matchingJobs as $job)
          <div class="card">
            <img src="{{ $job->company->logo }}" alt="{{ $job->company->company_name }}" />
            <div class="info">
              <div class="info-name">{{ $job->company->company_name }}</div>
              <div class="info-detail">
                📍 {{ $job->location }} &nbsp;&nbsp; 🕒 {{ $job->deadline }} &nbsp;&nbsp; 🕐 {{ $job->type_of_work }}
              </div>
            </div>
            <div class="match-percent">{{ $job->match_score }}%</div>
          </div>
        @endforeach
      </div>
    @else
      <!-- Tampilkan No Match jika tidak ada pekerjaan yang cocok -->
      <div class="no-match-box">
        <img src="https://cdn-icons-png.flaticon.com/512/1484/1484847.png" alt="No Match" />
        <span>No Match</span>
      </div>
    @endif

    <!-- Jika ada pekerjaan yang tidak cocok, tampilkan setelah pekerjaan yang cocok -->
    @if($matchingJobs->isNotEmpty() && $noMatchingJobs->isNotEmpty())
      <div class="subtitle">No match jobs:</div>
      <div class="grid">
        @foreach($noMatchingJobs as $job)
          <div class="card">
            <img src="{{ $job->company->logo }}" alt="{{ $job->company->company_name }}" />
            <div class="info">
              <div class="info-name">{{ $job->company->company_name }}</div>
              <div class="info-detail">
                📍 {{ $job->location }} &nbsp;&nbsp; 🕒 {{ $job->deadline }} &nbsp;&nbsp; 🕐 {{ $job->type_of_work }}
              </div>
            </div>
            <div class="match-percent">{{ $job->match_score }}%</div>
          </div>
        @endforeach
      </div>
    @endif

  </div>

  <footer class="footer">
    Terms & Conditions | Security & Privacy | Help Centre
  </footer>

  <style>
    /* Reset styling */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Ensure that the page takes full height */
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .main-container {
      flex-grow: 1; /* Ensure the content grows to fill available space */
      padding: 40px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #fff;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-icon {
      width: 24px;
      height: 24px;
      background-color: #111;
      border-radius: 4px;
    }

    .logo-text {
      font-size: 18px;
      font-weight: bold;
      color: #111;
    }

    .nav {
      display: flex;
      align-items: center;
      gap: 18px;
      font-size: 14px;
    }

    .nav img {
      width: 24px;
    }

    .breadcrumb {
      font-size: 14px;
      color: #333;
      padding: 20px 0;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    .breadcrumb a {
      text-decoration: none;
      color: #333;
    }

    .title-section {
      text-align: center;
      margin: 40px 0;
    }

    .title-section h1 {
      font-size: 32px;
      color: #2e3b4e;
    }

    .title-section small {
      font-size: 14px;
      color: #777;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px 30px;
      margin-bottom: 60px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .card {
      background-color: #c5cfd6;
      border-radius: 12px;
      padding: 16px;
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
      height: 120px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
    }

    .info {
      display: flex;
      flex-direction: column;
    }

    .info-name {
      font-weight: bold;
      font-size: 16px;
      color: #2e3b4e;
    }

    .info-detail {
      font-size: 13px;
      color: #333;
      margin-top: 4px;
    }

    .match-percent {
      position: absolute;
      top: 16px;
      right: 20px;
      font-weight: bold;
      font-size: 16px;
      color: #2e3b4e;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 13px;
      color: #444;
      border-top: 1px solid #ddd;
      background-color: #fff;
    }

    .no-match-box {
      margin: 0 auto;
      background-color: #c4cfd6;
      border-radius: 12px;
      width: 720px;
      height: 160px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .no-match-box img {
      width: 40px;
      height: 40px;
      margin-bottom: 8px;
    }

    .no-match-box span {
      font-size: 16px;
      font-weight: bold;
      color: #2f3e51;
    }
  </style>
