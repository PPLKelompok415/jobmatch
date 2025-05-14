@extends('layouts.app')

@section('content')
<header class="topbar">
    <div><strong><span style="background:#222;color:#fff;padding:4px 8px;border-radius:4px;">J</span> JOBMATCH</strong></div>
    <div>🌐 Language &nbsp;&nbsp; | &nbsp;&nbsp; Employer site &nbsp;&nbsp; <img src="https://via.placeholder.com/30" alt="Profile" style="border-radius: 50%;" /></div>
</header>

<nav class="menu">
    <div>Bookmark</div>
    <div>Community</div>
    <div>Notification & Announcement</div>
</nav>

<div class="content">
    <div class="title" style="font-size:2.5rem;font-weight:700;margin-top:32px;">MATCH</div>
    <div class="subtitle" style="margin-bottom:32px;">0 companies</div>

    <div class="no-match-box">
        <div class="icon">
            <svg width="48" height="48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="48" height="48" rx="12" fill="#b0bbc3"/>
                <g>
                    <ellipse cx="24" cy="18" rx="10" ry="4" fill="#fff"/>
                    <ellipse cx="24" cy="24" rx="10" ry="4" fill="#fff"/>
                    <ellipse cx="24" cy="30" rx="10" ry="4" fill="#fff"/>
                    <ellipse cx="24" cy="18" rx="10" ry="4" fill="#b0bbc3" fill-opacity="0.3"/>
                    <ellipse cx="24" cy="24" rx="10" ry="4" fill="#b0bbc3" fill-opacity="0.3"/>
                    <ellipse cx="24" cy="30" rx="10" ry="4" fill="#b0bbc3" fill-opacity="0.3"/>
                </g>
                <ellipse cx="24" cy="18" rx="8" ry="3" fill="#b0bbc3"/>
            </svg>
        </div>
        <div class="no-match-text" style="font-weight:600;font-size:1.1rem;margin-top:12px;color:#2e3e4e;">No Match</div>
    </div>
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
      font-size: 2.5rem;
      font-weight: bold;
      color: #2e3e4e;
    }
    .subtitle {
      font-size: 12px;
      color: #777;
      margin-bottom: 40px;
    }
    .no-match-box {
      width: 70%;
      max-width: 700px;
      min-height: 200px;
      margin: 0 auto;
      background-color: #bcc7cf;
      padding: 60px 0;
      border-radius: 16px;
      color: #2e3e4e;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .no-match-box .icon {
      margin-bottom: 8px;
    }
    .no-match-box .no-match-text {
      font-size: 1.2rem;
      font-weight: 600;
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
</style>
@endsection

