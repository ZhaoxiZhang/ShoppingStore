<?php 
require_once 'include_func.php';

check_admin_status();

$act = $_GET['act'];
if (isset($_GET['orderid']))
{
	$orderid = $_GET['orderid'];
}
else
{
	$orderid = null;
}


if ($act = "delorder")
{

	$result = del_order($orderid);
	if ($result)
	{
		do_url('list_order.php','删除成功，返回管理员列表');
	}
	else
	{
		do_url('list_order.php','删除失败，重新删除');
	}
}


?>
