<?php

include 'config.php';

$incomplete_jobs = mysqli_query($conn, "SELECT * FROM itissues WHERE status='Incomplete'");

$complete_jobs = mysqli_query($conn, "SELECT * FROM itissues WHERE status='Complete'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/admin_page.css"> 
   <link rel="stylesheet" href="css/logout_button.css"> 
   <title>Technician Page</title>
</head>
<body>
<div class="logout">
        <button onclick="location.href='logout.php';">Logout</button>
      </div>
   <div class="container">
      <div class="jobs">
         <h2>Incomplete Jobs</h2>
         <?php while($job = mysqli_fetch_assoc($incomplete_jobs)) { ?>
            <div class="job">
                <p><strong>First Name:</strong> <?php echo $job['firstname']; ?></p>
                <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
                <p><strong>Email:</strong> <?php echo $job['email']; ?></p>
                <p><strong>Description:</strong> <?php echo $job['description']; ?></p>
                <form action="update_status.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $job['id']; ?>">
                    <input type="hidden" name="status" value="Complete">
                    <button type="submit" class="btn">Mark as Complete</button>
                </form>
            </div>
         <?php } ?>
      </div>
      <div class="jobs">
         <h2>Completed Jobs</h2>
         <?php while($job = mysqli_fetch_assoc($complete_jobs)) { ?>
            <div class="job">
                <p><strong>First Name:</strong> <?php echo $job['firstname']; ?></p>
                <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
                <p><strong>Email:</strong> <?php echo $job['email']; ?></p>
                <p><strong>Description:</strong> <?php echo $job['description']; ?></p>
            </div>
         <?php } ?>
      </div>
   </div>
</body>
</html>
