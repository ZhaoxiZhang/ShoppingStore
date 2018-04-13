<?php
require_once 'include_func.php';


function add_employee()
{
	$ans = $_POST;
	
	if ($ans['sex'] == 1)
	{
		$ans['sex'] = "男";
	}
	elseif ($ans['sex'] == 2)
	{
		$ans['sex'] = "女";
	}
	
	$ans['entrytime'] = time();
	$query = insert("employee",$ans);
	if ($query)	return true;
	else return false;
}

function get_employee_list()
{
	$conn = db_connect();
	$query = "select * from employee order by employeeid";
	$result = @$conn->query($query);
	return $result;
}

function get_employee($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	return $result->fetch_assoc();
}

function edit_employee($employeeid)
{
	$ans = $_POST;
	//$ans['password'] = sha1($_POST['password']);
	$result = update("employee",$ans,"employeeid='{$employeeid}'");
	if ($result)	return true;
	else	return false;
}

function del_employee($employeeid)
{
	$result = delete("employee","employeeid='{$employeeid}'");
	if ($result)	return true;
	else	return false;
}

?>