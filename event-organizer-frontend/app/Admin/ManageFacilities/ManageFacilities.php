<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Facilities</title>
  <link href='/uep-event-booking/event-organizer-frontend/css/adminStyles.css' rel='stylesheet'>
</head>
<body>

  <!-- Header -->
  <header class="admin-header">
    <div class="admin-header-left">
      <div class="admin-logo">UEP</div>
      <nav class="admin-nav">
        <a href="../Dashboard/AdminDashboard.php">Dashboard</a>
        <a href="../ManageUsersPage/ManageUsers.php">Manage Users</a>
        <a href="../ManageFacilities/ManageFacilities.php">Manage Facilities</a>
      </nav>
    </div>
    <div class="admin-user">Juan Dela Cruz</div>
  </header>

  <!-- Manage Facilities -->
  <section class="admin-dashboard">
    <div class="admin-breadcrumb">Manage Facilities &gt;</div>

    <!-- Facility Details -->
    <div class="admin-facility-details">
      <div class="admin-facility-img"></div>
      <div class="admin-facility-info">
        <h2>Centennial</h2>
        <p><strong>Location:</strong> GM58+CVW University of Eastern, Catarman, Northern Samar</p>
        <p><strong>Capacity:</strong> 500 pax</p>
        <p><strong>Status:</strong> <span class="admin-status">Available</span></p>
      </div>
    </div>

    <!-- Search -->
    <div class="admin-search">
      <input type="text" placeholder="Search Facility">
    </div>

    <!-- Facility Table -->
    <table class="admin-table">
      <thead>
        <tr>
          <th>Facility</th>
          <th>Location</th>
          <th>Capacity</th>
          <th>Status</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Centennial</td>
          <td>GM58+CVW University of Eastern, Catarman, N. Samar</td>
          <td>500</td>
          <td>Available</td>
          <td>/uploads/gym.jpg</td>
        </tr>
      </tbody>
    </table>
  </section>

   <script src="/uep-event-booking/event-organizer-frontend/js/admin.js"></script>
</body>
</html>
