<!DOCTYPE HTML>
<html>
<head>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="media/style/jquery.formstyler.css">
  <link rel="stylesheet" type="text/css" href="media/style/registration.css">

</head>
<body>



<?php
//connection with database
include 'includes/db.php';

// define variables and set to empty values
$nameErr = $emailErr =  $passErr = "";
$login = $email = $gender = $password = "";
$promiseCount = 0; //Shound be 4

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["login"])) {
    $nameErr = "Name is required";
  } else {
    $login = test_input($_POST["login"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$login)) {
      $nameErr = "Only letters and white space allowed";
    }
    else{
      $promiseCount++;
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
      else{
      $promiseCount++;
    }
  }


  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
    $promiseCount++;
  }
}

  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
    $promiseCount++;
  }


//INSERT into database

if($promiseCount == 4){
mysqli_query($connection,"INSERT INTO `users` (email,gender,login,password)
  VALUES ('$email','$gender','$login','$password')");
echo '<h2>Поздровляем вы зарегестрировались!</h2>';
}

//SECURITY FUNCTION
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<div id='reg-title'>Registration Form</div>

<div class="container">

<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="myForm">
 <div class="form-group">
  Name: <input  class="styler" type="text" name="login" placeholder="Enter your name" value="<?php echo $login;?>" required>
  <span class="error">* <?php echo $nameErr;?></span>
  </div>
<div class="form-group">
  E-mail: <input type="text" class="styler" name="email" placeholder="Enter your email" value="<?php echo $email;?>" required>
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  </div>
  <div class="form-group">
  Password: <input type="password" class="styler" name="password" placeholder="enter your password" required>
 <span class="error">* <?php echo $passwordErr;?></span>
  <br>
  </div>
  <div class="form-group">
  Gender:
  <input type="radio" class="styler" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" class="styler" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  </div>
  <input type="submit" name="submit" value="Submit" class="styler submit">
</form>



</div>


<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous" defer></script>
<script type="text/javascript" src='media/js/jquery.formstyler.min.js' defer></script>
<script type="text/javascript" src="media/js/registration.js" defer></script>

</body>
</html>




