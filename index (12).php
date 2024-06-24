<?php
@include 'config.php';

session_start();

$formError = "";

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        if($row['user_type'] == 'technician'){
            header('location:admin_page.php');
            exit();
        } elseif($row['user_type'] == 'staff'){
            header('location:staff_page.php');
            exit();
        }
    } else {
        $formError = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/login_form.css">
   <title>Login</title>
</head>
<body>
   <div class="container">
      <div class="content">
         <div class="logo">
            <img src="assets/project.png" alt="logo">
            WearView IT
         </div>
         <h1>Login</h1>

         <?php if ($formError): ?>
            <?php include 'modal_wrong_details.php'; ?>
            <script src="js/modal.js"></script>
            <script>
               var modal = document.getElementById("myModal");
               modal.style.display = "block";
            </script>
         <?php endif; ?>
         <form class="login-form" id="login-form" method="POST" action="">
            <div class="input__group">
               <input type="text" id="username" name="username" placeholder=" ">
               <label for="username">Username</label>
               <span class="error__field"></span>
            </div>
            <div class="input__group">
               <input type="password" id="password" name="password" placeholder=" ">
               <label for="password">Password</label>
               <span class="error__field"></span>
            </div>
            <button type="submit" name="submit">Login</button>
         </form>
      </div>
      <div class="image"></div>
   </div>
   <script src="js/login_form.js"></script>
</body>
</html>
