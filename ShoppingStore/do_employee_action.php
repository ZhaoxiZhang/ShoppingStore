<?php 
require_once 'include_func.php';

check_admin_status();

$act = $_GET['act'];
if (isset($_GET['employeeid']))
{
	$employeeid = $_GET['employeeid'];
}
else
{
	$employeeid = null;
}

if ($act = "delemployee")
{
 	$result = del_employee($employeeid);
	if ($result)
	{
		do_url('list_employee.php','删除成功，返回员工列表');
	}
	else
	{
		do_url('list_employee.php','删除失败，重新删除');
	}
}


?>




