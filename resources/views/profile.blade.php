<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobMatch Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
  </style>
</head>
<body class="bg-light">

  <!-- Header -->
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
        <img src="https://i.pravatar.cc/40" alt="profile" class="profile-pic">
      </div>
    </div>
  </nav>

  <!-- Submenu -->
  <div class="border-bottom px-4 py-2 small">
    <a href="#" class="me-3 text-decoration-none text-dark">Bookmark</a>
    <a href="#" class="me-3 text-decoration-none text-dark">Community</a>
    <a href="#" class="text-decoration-none text-dark">Notification & Announcement</a>
  </div>

  <!-- Profile Card -->
  <div class="container my-4">
    <div class="profile-card p-4 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="fw-bold mb-2">Fazrul Ediyansyah</h5>
        <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>Bandung, Jawa Barat</p>
        <p><i class="bi bi-envelope-fill me-2"></i>Fazrulediyansyah@gmail.com</p>
        <button class="btn btn-outline-light mt-2" onclick="toggleEditForm()">Edit</button>
      </div>
      <img src="https://i.pravatar.cc/80" class="profile-pic" alt="Profile">
    </div>

    <!-- Edit Form -->
    <div id="editForm" class="bg-white p-4 mt-3 rounded shadow-sm d-none">
      <h5 class="fw-bold mb-3">Edit Personal Detail</h5>
      <form method="POST" action="/update_profile" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" name="full_name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cv" class="form-label">CV</label>
            <input class="form-control" type="file" id="cv" name="cv">
          </div>
          <div class="col-md-6 mb-3">
            <label for="portfolio" class="form-label">Portfolio</label>
            <input class="form-control" type="file" id="portfolio" name="portfolio">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-top py-3 text-center text-muted small">
    <a href="#" class="me-3 text-decoration-none text-muted">Terms & Conditions</a>
    <a href="#" class="me-3 text-decoration-none text-muted">Security & Privacy</a>
    <a href="#" class="text-decoration-none text-muted">Help Centre</a>
  </footer>

  <!-- Bootstrap & Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleEditForm() {
      const form = document.getElementById("editForm");
      form.classList.toggle("d-none");
    }
  </script>
</body>
</html>
