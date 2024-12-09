<?php

include("includes/header.php");
include("includes/topbar.php");
include("includes/siderbar.php");
include("config.php");

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
            <li class="breadcrumb-item"><a href="admin_index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Posted Jobs</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <?php
        if (isset($_GET['user_id'])) {
          $user_id = $_GET['user_id'];  // Get the company ID from the URL
          
          // Query to get the company details from the database
          $query = "SELECT * FROM company WHERE id='$user_id' LIMIT 1";
          $query_run = mysqli_query($conn, $query);
        
          if (!$query_run) {
              echo "Error: " . mysqli_error($conn);
          }

          // Check if the record exists
          if (mysqli_num_rows($query_run) > 0) {
              $row = mysqli_fetch_assoc($query_run);
        ?>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Job Posted List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <form action="admin_job_post_details_update_dbfile.php" method="POST" enctype="multipart/form-data">
              <input class="form-control" type="hidden" name="user_id" value="<?php echo $row['id']; ?>" required>
              <div class="form-group">
              <label for="company_name">Company Name:</label>
              <input type="text" name="company_name" class="form-control" id="company_name" value="<?php echo $row['company_name']; ?>" required>
              </div>

              <div class="form-group">
              <label for="job_title">Job Title:</label>
              <input type="text" name="job_title" class="form-control" id="job_title" value="<?php echo $row['job_title']; ?>" required>
              </div>

              <div class="form-group">
              <label for="job_type">Job Type:</label>
              <input type="text" name="job_type" id="job_type" class="form-control" value="<?php echo $row['job_type']; ?>" required>
              </div>

              <div class="form-group">
              <label for="schedule">Schedule:</label>
              <input type="text" name="schedule" id="schedule" class="form-control" value="<?php echo $row['schedule']; ?>" required>
              </div>

              <div class="form-group">
              <label for="job_location">Job Location:</label>
              <input type="text" name="job_location" id="job_location" class="form-control" value="<?php echo $row['job_location']; ?>" required>
              </div>

              <div class="form-group">
              <label for="salary">Salary:</label>
              <input type="number" name="salary" id="salary" class="form-control" value="<?php echo $row['pay']; ?>" required>
              </div>

              <div class="form-group">
              <label for="posted_days">Posted Days:</label>
              <input type="number" name="posted_days" id="posted_days" class="form-control"  value="<?php echo $row['posted_days']; ?>" required>
              </div>

              <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" name="image" id="image" class="form-control" accept="image/*">
              </div>
              <!-- Display the current company image if exists -->
              <?php if ($row['image']) { ?>
                  <div>
                      <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Current Job Image" width="100">
                  </div>
              <?php } else { ?>
                  <p>No image available.</p>
              <?php } ?>
              <div class="model-footer">
              <button type="submit" name="update_job" class="btn btn-info">Update Job Details</button>
              </div>
            </form>  

        <?php
          } else {
              echo "<h1>No Job Found!</h1>";
          }

          // Close connection
          mysqli_close($conn);
        }
        ?>

      </div>
    </div>

      </div>
    </div>
  </div>


</div>       
<?php

include("includes/footer.php");

?>
