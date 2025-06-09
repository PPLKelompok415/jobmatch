<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobMatch Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .profile-card {
      background-color: #2c3e50;
      color: white;
      border-radius: 15px;
    }
    .profile-pic {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
    }
    .profile-details p {
        margin-bottom: 0.5rem; /* Memberi sedikit jarak antar baris detail */
    }
    .profile-details i {
        width: 20px; /* Menyamakan lebar ikon */
        text-align: center;
    }
  </style>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg bg-white border-bottom px-4">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <div class="bg-dark text-white rounded me-2 px-2">J</div>
        <span class="fw-bold">JOBMATCH</span>
      </a>
      <div class="d-flex align-items-center gap-3">
        <a class="nav-link" href="#">Home</a>
        <a class="nav-link" href="#">Language</a>
        <a class="nav-link" href="#">Employer site</a>
        
        {{-- FOTO PROFIL DI HEADER --}}
        {{-- Menambahkan parameter v untuk cache-busting --}}
        <img src="{{ asset('storage/' . ($applicant->photo ?? 'default_profile.png')) }}?v={{ $applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp }}" alt="profile" class="profile-pic">
      </div>
    </div>
  </nav>

  <div class="border-bottom px-4 py-2 small">
    <a href="#" class="me-3 text-decoration-none text-dark">Bookmark</a>
    <a href="#" class="me-3 text-decoration-none text-dark">Community</a>
    <a href="#" class="text-decoration-none text-dark">Notification & Announcement</a>
  </div>

  <div class="container my-4">
    <div class="profile-card p-4 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="fw-bold mb-2">{{ $applicant->name ?? 'Nama Tidak Diketahui' }}</h5>
        <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>{{ $applicant->address ?? 'Alamat Tidak Diketahui' }}</p>
        <p><i class="bi bi-envelope-fill me-2"></i>{{ $applicant->email ?? 'Email Tidak Diketahui' }}</p>
        <button class="btn btn-outline-light mt-2" onclick="toggleEditForm()">Edit</button>
      </div>
      
      {{-- FOTO PROFIL DI PROFILE CARD --}}
      {{-- Menambahkan parameter v untuk cache-busting --}}
      <img src="{{ asset('storage/' . ($applicant->photo ?? 'default_profile.png')) }}?v={{ $applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp }}" class="profile-pic" alt="Profile">
    </div>

    {{-- Detail Profil Tambahan (Bagian Tampilan) --}}
    <div class="bg-white p-4 mt-3 rounded shadow-sm profile-details">
        <h5 class="fw-bold mb-3">Detail Pribadi</h5>
        <p><i class="bi bi-person-fill me-2"></i>Nama Panggilan: {{ $applicant->name ?? '-' }}</p>
        <p><i class="bi bi-person-fill me-2"></i>Nama Lengkap: {{ $applicant->full_name ?? '-' }}</p>
        <p><i class="bi bi-phone-fill me-2"></i>Nomor Telepon: {{ $applicant->phone_number ?? '-' }}</p>
        <p><i class="bi bi-calendar-date-fill me-2"></i>Tanggal Lahir: {{ $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d F Y') : '-' }}</p>
        <p><i class="bi bi-person-fill me-2"></i>Jenis Kelamin: {{ $applicant->gender ?? '-' }}</p>
        <p><i class="bi bi-building-fill me-2"></i>Institusi: {{ $applicant->institution ?? '-' }}</p>
        <p><i class="bi bi-book-fill me-2"></i>Jurusan: {{ $applicant->major ?? '-' }}</p>
        <p><i class="bi bi-calendar-check-fill me-2"></i>Tahun Kelulusan: {{ $applicant->graduation_year ?? '-' }}</p>
        <p><i class="bi bi-lightbulb-fill me-2"></i>Soft Skills: {{ $applicant->soft_skills ?? '-' }}</p>
        <p><i class="bi bi-star-fill me-2"></i>Hard Skills: {{ $applicant->hard_skills ?? '-' }}</p>
        <p><i class="bi bi-briefcase-fill me-2"></i>Posisi yang Diinginkan: {{ $applicant->desired_position ?? '-' }}</p>
        
        <h5 class="fw-bold mb-3 mt-4">Pengalaman Kerja & Preferensi</h5>
        <p><i class="bi bi-building-fill-add me-2"></i>Perusahaan Sebelumnya: {{ $applicant->work_company ?? '-' }}</p>
        <p><i class="bi bi-person-badge-fill me-2"></i>Posisi Sebelumnya: {{ $applicant->work_position ?? '-' }}</p>
        <p><i class="bi bi-journal-text me-2"></i>Deskripsi Pekerjaan: {{ $applicant->work_description ?? '-' }}</p>
        
        @if($applicant->certification)
            <p><i class="bi bi-patch-check-fill me-2"></i>Sertifikasi: <a href="{{ asset('storage/' . $applicant->certification) }}" target="_blank">Lihat Sertifikasi</a></p>
        @else
            <p><i class="bi bi-patch-check-fill me-2"></i>Sertifikasi: -</p>
        @endif
        
        <p><i class="bi bi-gear-fill me-2"></i>Tipe Pekerjaan: {{ $applicant->type_of_work ?? '-' }}</p>
        <p><i class="bi bi-geo-alt-fill me-2"></i>Lokasi Bekerja: {{ $applicant->location ?? '-' }}</p>
        <p><i class="bi bi-cash-stack me-2"></i>Rentang Gaji (Min): Rp {{ number_format($applicant->salary_min ?? 0, 0, ',', '.') }}</p>
        <p><i class="bi bi-cash-stack me-2"></i>Rentang Gaji (Max): Rp {{ number_format($applicant->salary_max ?? 0, 0, ',', '.') }}</p>
        <p><i class="bi bi-calendar-event-fill me-2"></i>Tanggal Ketersediaan: {{ $applicant->availability_date ? \Carbon\Carbon::parse($applicant->availability_date)->format('Y-m-d') : '-' }}</p>

        {{-- Link CV --}}
        @if($applicant->cv_file)
            <p><i class="bi bi-file-earmark-text-fill me-2"></i>CV: <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank">Lihat CV</a></p>
        @else
            <p><i class="bi bi-file-earmark-text-fill me-2"></i>CV: -</p>
        @endif

        {{-- Link Portfolio --}}
        @if($applicant->portfolio_file)
            <p><i class="bi bi-folder-fill me-2"></i>Portfolio: <a href="{{ asset('storage/' . $applicant->portfolio_file) }}" target="_blank">Lihat Portfolio</a></p>
        @else
            <p><i class="bi bi-folder-fill me-2"></i>Portfolio: -</p>
        @endif
    </div>

    {{-- FORM EDIT --}}
    <div id="editForm" class="bg-white p-4 mt-3 rounded shadow-sm d-none">
        <h5 class="fw-bold mb-3">Edit Detail Pribadi</h5>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops! Ada Kesalahan!</strong> Mohon periksa kembali input Anda.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- Nama Panggilan --}}
            <div class="mb-3">
                <label for="nickname" class="form-label">Nama Panggilan</label>
                <input type="text" class="form-control" id="nickname" name="name" value="{{ old('name', $applicant->name ?? '') }}" required>
                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Nama Lengkap --}}
            <div class="mb-3">
                <label for="fullName" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="fullName" name="full_name" value="{{ old('full_name', $applicant->full_name ?? '') }}" required>
                @error('full_name')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $applicant->email ?? ($user->email ?? '')) }}" required>
                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Phone Number --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number', $applicant->phone_number ?? '') }}" required>
                @error('phone_number')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $applicant->address ?? '') }}" required>
                @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('Y-m-d') : '') }}" required>
                @error('date_of_birth')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="male" {{ (old('gender', $applicant->gender ?? '') == 'male') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ (old('gender', $applicant->gender ?? '') == 'female') ? 'selected' : '' }}>Perempuan</option>
                    <option value="other" {{ (old('gender', $applicant->gender ?? '') == 'other') ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Institusi --}}
            <div class="mb-3">
                <label for="institution" class="form-label">Institusi</label>
                <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution', $applicant->institution ?? '') }}" required>
                @error('institution')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Jurusan --}}
            <div class="mb-3">
                <label for="major" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="major" name="major" value="{{ old('major', $applicant->major ?? '') }}" required>
                @error('major')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Tahun Kelulusan --}}
            <div class="mb-3">
                <label for="graduation_year" class="form-label">Tahun Kelulusan</label>
                <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $applicant->graduation_year ?? '') }}" min="1900" max="{{ date('Y') + 5 }}" required>
                @error('graduation_year')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Soft Skills --}}
            <div class="mb-3">
                <label for="soft_skills" class="form-label">Soft Skills</label>
                <textarea class="form-control" id="soft_skills" name="soft_skills" rows="3">{{ old('soft_skills', $applicant->soft_skills ?? '') }}</textarea>
                <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa skill.</small>
                @error('soft_skills')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Hard Skills --}}
            <div class="mb-3">
                <label for="hard_skills" class="form-label">Hard Skills</label>
                <textarea class="form-control" id="hard_skills" name="hard_skills" rows="3">{{ old('hard_skills', $applicant->hard_skills ?? '') }}</textarea>
                <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa skill.</small>
                @error('hard_skills')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            
            {{-- Posisi yang Diinginkan (Ditambahkan Kembali) --}}
            <div class="mb-3">
                <label for="desired_position" class="form-label">Posisi yang Diinginkan</label>
                <input type="text" class="form-control" id="desired_position" name="desired_position" value="{{ old('desired_position', $applicant->desired_position ?? '') }}" required>
                @error('desired_position')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Bagian Pengalaman Kerja & Preferensi --}}
            <h5 class="fw-bold mb-3 mt-4">Edit Pengalaman Kerja & Preferensi</h5>
            
            {{-- Work Company --}}
            <div class="mb-3">
                <label for="work_company" class="form-label">Perusahaan Sebelumnya</label>
                <input type="text" class="form-control" id="work_company" name="work_company" value="{{ old('work_company', $applicant->work_company ?? '') }}" required>
                @error('work_company')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Work Position --}}
            <div class="mb-3">
                <label for="work_position" class="form-label">Posisi Sebelumnya</label>
                <input type="text" class="form-control" id="work_position" name="work_position" value="{{ old('work_position', $applicant->work_position ?? '') }}" required>
                @error('work_position')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Work Description --}}
            <div class="mb-3">
                <label for="work_description" class="form-label">Deskripsi Pekerjaan</label>
                <textarea class="form-control" id="work_description" name="work_description" rows="3">{{ old('work_description', $applicant->work_description ?? '') }}</textarea>
                @error('work_description')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Certification File --}}
            <div class="mb-3">
                <label for="certification" class="form-label">Sertifikasi (PDF)</label>
                <input class="form-control" type="file" id="certification" name="certification">
                @if($applicant->certification)
                    <small class="text-muted">Sertifikasi Saat Ini: <a href="{{ asset('storage/' . $applicant->certification) }}" target="_blank">Lihat</a></small>
                @endif
                @error('certification')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Type of Work --}}
            <div class="mb-3">
                <label for="type_of_work" class="form-label">Tipe Pekerjaan</label>
                <select class="form-select" id="type_of_work" name="type_of_work" required>
                    <option value="">Pilih Tipe Pekerjaan</option>
                    <option value="Full-Time" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Full-Time') ? 'selected' : '' }}>Full-Time</option>
                    <option value="Part-Time" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Part-Time') ? 'selected' : '' }}>Part-Time</option>
                    <option value="Remote" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Remote') ? 'selected' : '' }}>Remote</option>
                    <option value="Freelance" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Freelance') ? 'selected' : '' }}>Freelance</option>
                    <option value="Internship" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Internship') ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type_of_work')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Location --}}
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi Bekerja</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $applicant->location ?? '') }}" required>
                @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                {{-- Salary Min --}}
                <div class="col-md-6 mb-3">
                    <label for="salary_min" class="form-label">Gaji Minimum (IDR)</label>
                    <input type="number" class="form-control" id="salary_min" name="salary_min" value="{{ old('salary_min', $applicant->salary_min ?? '') }}" min="0" required>
                    @error('salary_min')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                {{-- Salary Max --}}
                <div class="col-md-6 mb-3">
                    <label for="salary_max" class="form-label">Gaji Maksimum (IDR)</label>
                    <input type="number" class="form-control" id="salary_max" name="salary_max" value="{{ old('salary_max', $applicant->salary_max ?? '') }}" min="0" required>
                    @error('salary_max')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Availability Date --}}
            <div class="mb-3">
                <label for="availability_date" class="form-label">Tanggal Ketersediaan</label>
                <input type="date" class="form-control" id="availability_date" name="availability_date" value="{{ old('availability_date', $applicant->availability_date ? \Carbon\Carbon::parse($applicant->availability_date)->format('Y-m-d') : '') }}" required>
                @error('availability_date')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            
            <div class="row">
                {{-- CV File --}}
                <div class="col-md-6 mb-3">
                    <label for="cv" class="form-label">CV</label>
                    <input class="form-control" type="file" id="cv" name="cv_file">
                    @if($applicant->cv_file)
                        <small class="text-muted">CV Saat Ini: <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank">Lihat</a></small>
                    @endif
                    @error('cv_file')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                {{-- Portfolio File --}}
                <div class="col-md-6 mb-3">
                    <label for="portfolio" class="form-label">Portofolio</label>
                    <input class="form-control" type="file" id="portfolio" name="portfolio_file">
                    @if($applicant->portfolio_file)
                        <small class="text-muted">Portofolio Saat Ini: <a href="{{ asset('storage/' . $applicant->portfolio_file) }}" target="_blank">Lihat</a></small>
                    @endif
                    @error('portfolio_file')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>
            
            {{-- Photo Profile --}}
            <div class="mb-3">
                <label for="photo" class="form-label">Foto Profil</label>
                <input class="form-control" type="file" id="photo" name="photo">
                @if($applicant->photo)
                    <small class="text-muted">Foto Saat Ini: <img src="{{ asset('storage/' . $applicant->photo) }}" alt="Current Profile" class="profile-pic" style="width: 50px; height: 50px;"></small>
                @endif
                @error('photo')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>

  <footer class="border-top py-3 text-center text-muted small">
    <a href="#" class="me-3 text-decoration-none text-muted">Syarat & Ketentuan</a>
    <a href="#" class="me-3 text-decoration-none text-muted">Keamanan & Privasi</a>
    <a href="#" class="text-decoration-none text-muted">Pusat Bantuan</a>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleEditForm() {
      const form = document.getElementById("editForm");
      form.classList.toggle("d-none");
    }

    @if(session('success'))
        const successMessage = {{ Js::from(session('success')) }};
        const successAlert = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${successMessage}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        document.getElementById('editForm').insertAdjacentHTML('afterbegin', successAlert);
        document.getElementById("editForm").classList.remove("d-none");
    @endif

    @if ($errors->any())
      document.getElementById("editForm").classList.remove("d-none");
    @endif
  </script>
</body>
</html>
