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
              <li class="breadcrumb-item active">Registered Users</li>
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
                <h3 class="card-title">Registered Users List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>id</th>
                        <th> Job id</th>
                  
                        <th>Full name</th>
                        <th>Phone No.</th>
                        <th>Email(s)</th>
                        <th>Resume </th>
                        
                       
                        <th>Applying Time</th>
                       
                    </tr>
                 </thead>
                  <tbody>
                      <?php
                        $query = "SELECT * FROM applications";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                            foreach ($query_run as $row)
                             { ?>
                                <tr>
                                      <td> <?php echo $row['id'];?></td>
                                      <td> <?php echo $row['job_id'];?></td>
            
                                      <td> <?php echo $row['full_name']; ?></td>
                                      <td> <?php echo $row['mobile_no']; ?></td>
                                      <td> <?php echo $row['email']; ?></td>
                                      <td> <?php echo $row['resume']; ?></td>
                                    
                                    
                                      <td> <?php echo $row['applied_on']; ?></td>
                                      <td> 
                                      
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
            if (confirm("Are you sure you want to delete this User Application data?")) {
                // Redirect to delete_user.php with user_id as parameter
                window.location.href = "admin_delete_applying_job.php?user_id=" + userId;
            }
        });
    });
</script>



