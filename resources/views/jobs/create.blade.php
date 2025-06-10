<!DOCTYPE html>
<html>
<head>
  <title>Create Job</title>
</head>
<body>
  <h1>Create New Job</h1>

  <form action="{{ route('jobs.store') }}" method="POST">
    @csrf
    <label for="company_id">Company ID:</label>
    <input type="number" name="company_id" id="company_id" required><br><br>

    <label for="title">Job Title:</label>
    <input type="text" name="title" id="title" required><br><br>

    <label for="type_of_work">Type of Work:</label>
    <input type="text" name="type_of_work" id="type_of_work" required><br><br>

    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required><br><br>

    <button type="submit">Create Job</button>
  </form>

  <br>
  <a href="{{ route('jobs.index') }}">Back to Jobs</a>
</body>
</html>
