<?php
require_once 'include_func.php';
check_admin_status();
$url = htmlspecialchars($_SERVER["PHP_SELF"]).'?'.$_SERVER["QUERY_STRING"];



$orderid = $_GET['orderid'];
$query = "select * from orders where orderid = '{$orderid}'";
$result = get_order($query);

$goodsid = $result['goodsid'];

$qry = "select * from goods where goodsid = '{$goodsid}'";
$res = get_goods($qry);
$goodsname = $res['goodsname'];


//表单验证
$customerErr = $goodsErr = $numErr = $telErr = $addErr = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['customername']))
	{
		$customerErr = "顾客姓名字段必填";
	}
	
	if (empty($_POST['goodsname']))
	{
		$goodsErr = "商品名称字段必填";
	}
	else
	{
		$query = "select * from goods where goodsname = '{$_POST['goodsname']}';";
		$result = get_goods($query);
		if (!$result)
		{
			$goodsErr = "未找到所填商品";
		}
	}
	
	
	if (empty($_POST['ordernum']))
	{
		$numErr = "商品数量字段必填";
	}
	else
	{
		if (!is_numeric($_POST['ordernum']))
		{
			$numErr = "商品数量字段不合法";
		}
	}
	
	if (empty($_POST['tel']))
	{
		$telErr = "联系电话字段必填";
	}
	else
	{
		if (!is_numeric($_POST['tel']))
		{
			$telErr = "联系电话字段不合法";
		}
	}
	
	
	if (empty($_POST['address']))
	{
		$addErr = "收获地址字段必填";
	}
}

if (!empty($_POST) && $customerErr == null && $goodsErr == null && $numErr == null && $telErr == null && $addErr == null)
{
	$ans = $_POST;
	
	$goodsname = $ans['goodsname'];
	$query = "select * from goods where goodsname = '{$goodsname}';";
	$result = get_goods($query);
	
	$ans['goodsid'] = $result['goodsid'];
	$ans['amount'] = $ans['ordernum']*$result['currentprice'];
	$ans['ordertime'] = time();
	
	$tmp = array();
	$tmp['goodsname'] = $ans['goodsname'];
	$ans = array_merge(array_diff($ans, $tmp));
	
	
	$result = update("orders",$ans,"orderid='{$orderid}'");
	if ($result)
	{
		do_url('list_orders.php','更新订单成功，查看订单列表');
	}
	else
	{
		do_url('list_orders.php','更新订单失败，重新编辑订单');
	}
	exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Welcome</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/framework-all.css">
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/framework.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
</head>

<body>
    <form action="<?php echo $url;?>" method="post">
    <?php $result = get_order($query);?>
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 编辑订单信息">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>顾客姓名</td>
                            <td>
                                <input class="control material blue" type="text" name="customername" placeholder="<?php echo $result['customername'];?>" />
                            	<strong><?php echo $customerErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品名称</td>
                            <td>
                                <input class="control material blue" type="text" name="goodsname" placeholder="<?php echo $goodsname;?>" />
                            	<strong><?php echo $goodsErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品数量</td>
                            <td>
                                <input class="control material blue" type="text" name="ordernum" placeholder="<?php echo $result['ordernum'];?>" />
                            	<strong><?php echo $numErr; ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>联系电话/td>
                            <td>
                                <input class="control material blue" type="text" name="tel" placeholder="<?php echo $result['tel'];?>" />
                            	<strong><?php echo $telErr; ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>收获地址/td>
                            <td>
                                <input class="control material blue" type="text" name="address" placeholder="<?php echo $result['address'];?>" />
                            	<strong><?php echo $addErr; ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">提交</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</body>

</html>

