<?php 
require_once 'include_func.php';

check_admin_status();

$act = $_GET['act'];
if (isset($_GET['goodsid']))
{
	$goodsid = $_GET['goodsid'];
}
else
{
	$goodsid= null;
}

if (isset($_POST['catid']))
{
	$goodscatename = $_POST['catid'];	
}
else
{
	$goodscatename = null;
}

if ($act == "delgoods")
{
	$query = "select * from orders where goodsid = '{$goodsid}';";
	
	$result = get_order_list();
	@$num_orders = $result->num_rows;
	
	if ($num_orders != 0)
	{
		echo '有订单包含此商品，无法删除';
		echo '<br/>';
		do_url('list_orders.php','返回订单列表');
	}
	else
	{
		$result = del_goods($goodsid);
		if ($result)
		{
			do_url('list_goods.php','删除成功，返回商品列表');
		}
		else
		{
			do_url('list_goods.php','删除失败，重新删除');
		}
	}
}

?>




