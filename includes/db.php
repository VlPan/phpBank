<?php 

$connection = mysqli_connect('127.0.0.1','mysql','mysql','bank_db');

if($connection == false){
	echo'<br> не дулаось подключиться к базе данных!<br>';
	echo mysqli_connect_error();
	exit();
}
