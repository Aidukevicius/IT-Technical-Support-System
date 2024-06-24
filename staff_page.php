<?php

include 'config.php';

session_start();

$formSubmitted = false;
$formError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $location = $_POST["location"];
    $email = $_POST["email"];
    $description = $_POST["description"];

   
    if (empty($firstname) || empty($location) || empty($email) || empty($description)) {
        $formError = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = "Invalid email format.";
    } else {
        $sql = "INSERT INTO itissues (firstname, location, email, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $location, $email, $description);
        
        if (mysqli_stmt_execute($stmt)) {
            $formSubmitted = true;
        } else {
            $formError = "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/staff_page.css">
  <link rel="stylesheet" href="css/logout_button.css">
  <title>Log IT Issues</title>
</head>
<body>
  <div class="container">
    <div class="content">
      <div class="logo">
        <img src="assets/project.png" alt="logo">
        WearView IT
      </div>
      <div class="logout">
        <button onclick="location.href='logout.php';">Logout</button>
      </div>
      <h1>Report IT Issue</h1>
      <?php if ($formSubmitted): ?>
        <?php include 'modal_form_successful.php'; ?>
        <script src="js/modal.js"></script>
        <script>
          var modal = document.getElementById("myModal");
          modal.style.display = "block";
        </script>
      <?php elseif ($formError): ?>
        <p class="error-message"><?php echo $formError; ?></p>
      <?php endif; ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form">
        <input type="hidden" id="form-submitted" value="<?php echo $formSubmitted ? 'true' : 'false'; ?>">
        <div class="input__row">
          <div class="input__group">
            <input type="text" id="firstname" name="firstname" placeholder=" ">
            <label for="firstname">First Name</label>
            <span class="error__field"></span>
          </div>
          <div class="input__group">
            <input type="text" id="location" name="location" placeholder=" ">
            <label for="location">Location</label>
            <span class="error__field"></span>
          </div>
        </div>
        <div class="input__group">
          <input type="text" id="email" name="email" placeholder=" ">
          <label for="email">Email</label>
          <span class="error__field"></span>
        </div>
        <div class="input__group">
          <input type="text" id="description" name="description" placeholder=" ">
          <label for="description">Description</label>
          <span class="error__field"></span>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
    <div class="image"></div>
  </div>
  <script src="js/staff_page.js"></script>
</body>
</html>
