<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href='/uep-event-booking/event-organizer-frontend/css/adminStyles.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
</head>
<body>

  <!-- Header -->
  <header class="admin-header">
    <div class="admin-header-left">
      <div class="admin-logo">UEP</div>
      <nav class="admin-nav">
        <a href="../Dashboard/AdminDashboard.php" class="active">Dashboard</a>
        <a href="../ManageUsersPage/ManageUsers.php">Manage Users</a>
        <a href="../ManageFacilities/ManageFacilities.php">Manage Facilities</a>
      </nav>
    </div>
    <div class="admin-user">Juan Dela Cruz</div>
  </header>

  <!-- Dashboard -->
  <section class="admin-dashboard">
    <div class="admin-breadcrumb">Dashboard &gt;</div>

    <!-- Quick Stats -->
    <div class="admin-stats">
      <div class="stat-card">
        <h3>24</h3>
        <p>Events this Week</p>
      </div>
      <div class="stat-card">
        <h3>5</h3>
        <p>Pending Requests</p>
      </div>
      <div class="stat-card">
        <h3>128</h3>
        <p>Total Users</p>
      </div>
    </div>z

    <!-- Main Layout -->
    <div class="admin-main">
      <!-- Calendar -->
      <div class="calendar-container">
        <h2>Event Calendar</h2>
        <div id="calendar"></div>
      </div>

      <!-- Right Sidebar -->
      <aside class="admin-sidebar">
        <!-- Upcoming Events -->
        <div class="widget">
          <h3>Upcoming Events</h3>
          <ul class="event-list">
            <li><strong>Seminar</strong> – Oct 5, 2025</li>
            <li><strong>Workshop</strong> – Oct 6, 2025</li>
            <li><strong>Sports Meet</strong> – Oct 7, 2025</li>
          </ul>
        </div>

        <!-- Pending Requests -->
        <div class="widget">
          <h3>Pending Requests</h3>
          <ul class="request-list">
            <li>Request #101 – Gymnasium</li>
            <li>Request #102 – Audio-Visual Room</li>
            <li>Request #103 – Library Hall</li>
          </ul>
          <a href="../ManageRequests/Requests.php" class="btn-view">View All</a>
        </div>

        <!-- Quick Actions -->
        <div class="widget">
          <h3>Quick Actions</h3>
          <button class="btn-action">+ Add User</button>
          <button class="btn-action">Generate Report</button>
          <button class="btn-action">Manage Facilities</button>
        </div>
      </aside>
    </div>

    <!-- Search -->
    <div class="admin-search">
      <input type="text" placeholder="Search User">
    </div>

    <!-- User Table -->
    <table class="admin-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Juan Dela Cruz</td>
          <td>d.juan@gmail.com</td>
          <td>09432560981</td>
          <td>Dalakit, Catarman N. Samar</td>
          <td>User</td>
        </tr>
        <tr>
          <td>Maria Santos</td>
          <td>m.santos@gmail.com</td>
          <td>09234567890</td>
          <td>Rawis, Catarman N. Samar</td>
          <td>Project Manager</td>
        </tr>
        <tr>
          <td>Pedro Reyes</td>
          <td>p.reyes@gmail.com</td>
          <td>09345678912</td>
          <td>Tinigao, Catarman N. Samar</td>
          <td>USC</td>
        </tr>
      </tbody>
    </table>
  </section>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js" defer></script>
<script src="/uep-event-booking/event-organizer-frontend/js/admin.js"></script>
<script src="/uep-event-booking/event-organizer-frontend/js/calendar.js"></script>
</body>
</html>
