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

                            
        
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job Posted List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>id</th>
                        <th>Company Name	</th>
                        <th>Job Title</th>
                        <th>	Job Type</th>
                        <th>	Schedule</th>
                        <th>Job Location</th>
                        <th>	Salary</th>
                        <th>Posted Days</th>
                        <th>	Image</th>
                       
                    </tr>
                 </thead>
                  <tbody>
                      <?php
                        $query = "SELECT * FROM company";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                            foreach ($query_run as $row)
                             { ?>
                                <tr>
                                      <td> <?php echo $row['id'];?></td>
                                     
                                      <td> <?php echo $row['company_name']; ?></td>
                                      <td> <?php echo $row['job_title']; ?></td>
                                      <td> <?php echo $row['job_type']; ?></td>
                                      <td> <?php echo $row['schedule']; ?></td>
                                      <td> <?php echo $row['job_location']; ?></td>
                                    
                                      <td> <?php echo $row['pay']; ?></td>
                                      <td> <?php echo $row['posted_days']; ?></td>
                                      <td> <?php echo "<img src= '" . $row['image'] ."' style='width:100px; height:150px;'>" ?></td>
                                      
                                      <td> 
                                      <a href="admin_update_job_post.php?user_id=<?php echo $row['id']; ?>" class="btn-info">Edit</a>
                                      <button type="button" value="<?php echo $row['id']; ?>" class ="btn-danger deletebtn">Delete</button>
                                      </td>
                                      
                                
                                </tr>
                                <?php
                             }
                        }
                         else 
                         {
                            echo "No users found or query failed.";
                         }
                        ?>                        
                    
                </tbody>  
                </table>
            </div>
        </div>

                </div>
            </div>
        </div>


</div>       
<?php

include("includes/footer.php");
?>
<script>
    // Handle the delete button click
    document.querySelectorAll('.deletebtn').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.value;
            // Show confirmation dialog
            if (confirm("Are you sure you want to delete this job?")) {
                // Redirect to delete_user.php with user_id as parameter
                window.location.href = "admin_delete_post.php?user_id=" + userId;
            }
        });
    });
</script>



