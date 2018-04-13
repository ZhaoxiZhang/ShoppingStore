<?php 
require_once 'include_func.php';

check_admin_status();

$act = $_GET['act'];
if (isset($_GET['adminid']))
{
	$adminid = $_GET['adminid'];
}
else
{
	$adminid = null;
}

if ($act = "deladmin")
{

	$result = del_admin($adminid);
	if ($result)
	{
		do_url('list_admin.php','删除成功，返回管理员列表');
	}
	else
	{
		do_url('list_admin.php','删除失败，重新删除');
	}
}

?>
