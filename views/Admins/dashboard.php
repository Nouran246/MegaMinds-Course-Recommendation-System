<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <style>
      .stat-card {
        margin-bottom: 2rem;
      }
      .stat-list {
        padding-left: 0;
        list-style: none;
      }
      .stat-list li {
        background: #f8f9fa;
        margin-bottom: 0.5rem;
        padding: 1rem;
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      }
    </style>
  </head>
  <body>
    <!-- Direct header inclusion -->
    <header class="bg-dark text-white p-3">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="h3">Admin Dashboard</h1>
          <nav>
            <a href="dashboard.php" class="text-white">Dashboard</a>
            <a href="members.php" class="text-white ml-3">Members</a>
            <a href="courses.php" class="text-white ml-3">Settings</a>
            <a href="/logout" class="text-white ml-3">Logout</a>
          </nav>
        </div>
      </div>
    </header>

    <div id="content" class="content container mt-5">
      <div class="row mb-4">
        <div class="col">
          <h1>Dashboard</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card text-white bg-primary stat-card" data-aos="fade-up">
            <div class="card-body">
              <h5 class="card-title">Total Members</h5>
              <p class="card-text" id="totalMembers"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div
            class="card text-white bg-success stat-card"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <div class="card-body">
              <h5 class="card-title">Board Members</h5>
              <p class="card-text" id="boardMembers"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div
            class="card text-white bg-warning stat-card"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <div class="card-body">
              <h5 class="card-title">Total Warnings</h5>
              <p class="card-text" id="totalWarnings"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div
            class="card text-white bg-danger stat-card"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div class="card-body">
              <h5 class="card-title">Total Points</h5>
              <p class="card-text" id="totalPoints"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div
            class="card text-white bg-info stat-card"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <div class="card-body">
              <h5 class="card-title">Members with Warnings</h5>
              <p class="card-text" id="membersWithWarnings"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div
            class="card text-white bg-secondary stat-card"
            data-aos="fade-up"
            data-aos-delay="500"
          >
            <div class="card-body">
              <h5 class="card-title">Average Points per Member</h5>
              <p class="card-text" id="avgPoints"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-body">
              <h5 class="card-title">Members per Department</h5>
              <ul class="stat-list" id="membersPerDepartment"></ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card" data-aos="fade-up" data-aos-delay="700">
            <div class="card-body">
              <h5 class="card-title">Members per Year</h5>
              <ul class="stat-list" id="membersPerYear"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        fetch("/admin/api/dashboard")
          .then((response) => response.json())
          .then((data) => {
            document.getElementById("totalMembers").innerText =
              data.stats.totalMembers;
            document.getElementById("boardMembers").innerText =
              data.stats.boardMembers;
            document.getElementById("totalWarnings").innerText =
              data.stats.totalWarnings;
            document.getElementById("totalPoints").innerText =
              data.stats.totalPoints;
            document.getElementById("membersWithWarnings").innerText =
              data.stats.membersWithWarnings;
            document.getElementById("avgPoints").innerText =
              data.stats.avgPoints.toFixed(2);

            const membersPerDepartment = data.stats.membersPerDepartment
              .map((dept) => `<li>${dept._id}: ${dept.count}</li>`)
              .join("");
            document.getElementById("membersPerDepartment").innerHTML =
              membersPerDepartment;

            const membersPerYear = data.stats.membersPerYear
              .map((year) => `<li>${year._id}: ${year.count}</li>`)
              .join("");
            document.getElementById("membersPerYear").innerHTML =
              membersPerYear;

            AOS.init();
          })
          .catch((error) => {
            console.error("Error fetching data:", error);
          });
      });
    </script>
  </body>
</html>
