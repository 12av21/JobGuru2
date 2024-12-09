<?php
// Include database connection config file
include("config.php"); 
include("includes/header.php");
include("includes/topbar.php");
include("includes/siderbar.php");

// Query to count the number of users in the 'users' table
$sql = "SELECT COUNT(*) AS user_count FROM users";
$result = $conn->query($sql);

// Check if the query was successful and fetch the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];
} else {
    $user_count = 0;  // In case there are no users in the database
}


// Query to count the number of users in the 'users' table
$sql = "SELECT COUNT(*) AS post_count FROM company";
$result = $conn->query($sql);

// Check if the query was successful and fetch the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $post_count = $row['post_count'];
} else {
    $post_count = 0;  // In case there are no users in the database
}

// Query to count the number of users in the 'users' table
$sql = "SELECT COUNT(*) AS apply_count FROM applications";
$result = $conn->query($sql);

// Check if the query was successful and fetch the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $apply_count = $row['apply_count'];
} else {
    $apply_count = 0;  // In case there are no users in the database
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="admin_index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $apply_count; ?><sup style="font-size: 20px">%</sup></h3>
              <p>Applying for jobs</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="admin_user_applying_job.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $user_count; ?></h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="admin_registered.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $post_count; ?></h3>
              <p>Posted Jobs</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="admin_job_post_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>

</div>

<?php
// Include footer
include("includes/footer.php");
?>
