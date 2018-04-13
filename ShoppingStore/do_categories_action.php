<?php 
require_once 'include_func.php';

check_admin_status();

$act = $_GET['act'];
if (isset($_GET['catid']))
{
	$catid = $_GET['catid'];
}
else
{
	$catid = null;
}


if ($act = "delcate")
{
	$query = "select * from goods where catid = '{$catid}';";
	$result = get_goods_list($query);
	@$num_goods = $result->num_rows;
	if ($num_goods != 0)
	{
		echo '该分类下存在商品，无法删除';
		echo '<br/>';
		do_url('list_goods.php','返回商品列表');
	}
	else
	{
		$result = del_categories($catid);
		if ($result)
		{
			do_url('list_categories.php','删除成功，返回分类列表');
		}
		else
		{
			do_url('list_categories.php','删除失败，重新删除');
		}
	}
}


?>