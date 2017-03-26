
<?php 	session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Handler page</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../media/style/create_acc.css">
</head>
<body>

<?php

include('db.php');


 //Получаем данные с формы
$_SESSION['login'] = $login = $_POST['login'];
$_SESSION['password'] = $password = $_POST['password'];




$count = mysqli_query($connection,"SELECT * FROM `users` WHERE `login` = '$login'  AND `password` = '$password'");
$user = mysqli_fetch_assoc($count);
$_SESSION['id'] = $id = $user['id'];

if(!isset($_GET['user_agreement'])){
if(mysqli_num_rows($count) == 0){
	echo 'Вы не зарегестрированы!';
	echo '<br>Ваш логин: ' . $_POST['login'] . '<br>Ваш Пороль: ' .$_POST['password'] . '<br>';
	exit();
}

//Проверяем первый раз пользователь зашел или нет



$id = $user['id'];
$enter_time = date('Y-m-d H:i:s');
$last_enter = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `last_enter_time` WHERE `users_id` = '$id'"))['last_enter']; //Последнее время входа

if($last_enter == '0000-00-00 00:00:00' || !$last_enter) {

 	include '../create_acc.php'; // Create new acc form.
}else{


		$start_date_timestamp = strtotime($last_enter);
		$time_between = floor((time() - $start_date_timestamp)/60/60/24);
		$account = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `account` WHERE `users_id` = '$id'"));
		$account_id = $account["id"];
		$rate = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `rate_table` WHERE `account_id` = '$account_id'"));
		//Обновляем счет в зависимости от проц. ставки
		$current_balance_state = floor($account['balance_state'] + ($account['balance_state'] * ($rate['rate'] * $time_between)));
		mysqli_query($connection,"UPDATE `account` SET `balance_state` = '$current_balance_state' WHERE `users_id` = '$id'");



//Обновляем время входа

$update = mysqli_query($connection,"UPDATE `last_enter_time` SET last_enter = '$enter_time' WHERE `users_id` = '$id'");

//Выводим данные
echo '<br>Ваш логин: ' . $_POST['login'] . '<br>Ваш Пороль: ' .$_POST['password'] . '<br>';
echo '<h2>Ваш счет:</h2>' .$current_balance_state.'<hr>';
echo '<h2>Ваша процентная ставка:</h2>' .$rate['rate'].'<hr>';
echo '<h2>Время в днях:</h2>' . $time_between .' дней	<hr>';

}
}else{

	$id = $_SESSION['id'];
	echo 'Работает!!!!!';
	mysqli_query($connection,"INSERT INTO `account`(users_id,balance_state) VALUES('$id','0')");
}

 ?>

<script type="text/javascript" src="../media/js/create_acc.js" defer></script>
</body>
</html>


