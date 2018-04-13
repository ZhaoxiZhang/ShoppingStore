<?php
require_once 'include_func.php';

$username = $_POST ['username'];
$password = $_POST ['password'];

if ($username && $password)
{
	try
	{
		login ( $username, $password );
		$_SESSION ['admin_user'] = $username;
		echo "<script> window.location = 'index.php'; </script>;";
	}
	catch ( Exception $e )
	{
		alert_message ("账号或密码错误，请重新尝试", "login.php" );
	}
}

?>