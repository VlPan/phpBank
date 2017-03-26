<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Вход в банк</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="media/style/registration.css">
</head>
<body>

<div class="container" style="margin-top: 250px;">


<form action="includes/handler.php" method="POST">

		<h2 style="color: #ff9999; padding: 15px;">Sign In Form</h2>
	<div class="form-group">
      <label for="usr">Login:</label>
      <input type="text" class="form-control" id="usr" name="login" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password" required>
    </div>

 		<input type="submit" name="submit" value="Sign In" class="btn btn-default">
  </form>

<div>
</body>
</html>