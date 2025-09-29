<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
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

  <!-- Manage Users -->
  <section class="admin-dashboard">
    <div class="admin-breadcrumb">Manage Users &gt;</div>

    <!-- Tabs -->
    <div class="admin-tabs">
      <div class="admin-tab active">USERS <span>00</span></div>
      <div class="admin-tab">STAFF <span>00</span></div>
      <div class="admin-tab">USC <span>00</span></div>
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
      </tbody>
    </table>
  </section>

   <script src="/uep-event-booking/event-organizer-frontend/js/admin.js"></script>
</body>
</html>
