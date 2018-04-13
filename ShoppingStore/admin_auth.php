<?php
require_once 'include_func.php';


function login($username, $password)
{
	$conn = db_connect ();
	if (! $conn)
	{
		return 0;
	}
	
	$result = $conn->query ( "select * from admin
							where username = '" . $username . "'
							and password = sha1('" . $password . "')" );
	if (! $result)
	{
		throw new Exception ( '没有此账号，您无法登录！' );
	}
	
	if ($result->num_rows > 0)
	{
		return true;
	}
	else
	{
		throw new Exception ( '没有此账号，您无法登录！' );
	}
	
}

function check_admin_status()
{
	if (!isset ( $_SESSION ['admin_user'] ))
	{
		alert_message("请先登录","login.php");
	}
}

function add_admin()
{
	$ans = $_POST;
	//print_r($ans);
	//$ans['password'] = sha1($_POST['password']);
	$query = insert("admin",$ans);
	if ($query)	return true;
	else return false;
}

function get_admin_list($where = null)
{
	$where = $where == null?null : "where {$where}";
	$conn = db_connect();
	$query = "select * from admin {$where} order by adminid;";
	//echo $query.'<br/>';
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	 return $result;
}

function get_admin($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	return $result->fetch_assoc();
}

function edit_admin($adminid)
{
	$ans = $_POST;
	$ans['password'] = sha1($_POST['password']);
	$result = update("admin",$ans,"adminid='{$adminid}'");
	if ($result)	return true;
	else	return false;
}

function del_admin($adminid)
{
	$result = delete("admin","adminid='{$adminid}'");
	if ($result)	return true;
	else	return false;
}



?>