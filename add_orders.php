<?php
require_once 'include_func.php';

check_admin_status();

$customerErr = $goodsErr = $numErr = $telErr = $addErr = null;
$url = htmlspecialchars($_SERVER["PHP_SELF"]);


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
	
	
	$query = insert("orders",$ans);
	if ($query)
	{
		do_url('list_orders.php','添加成功，查看订单列表');
		echo '<br/>';
		do_url('add_orders.php','添加成功，继续添加');
	}
	else
	{
		do_url('add_orders.php','添加失败，重新添加');
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 添加订单">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover">
                        <tr>
                            <td>顾客姓名</td>
                            <td>
                                <input class="control rounded" type="text" name="customername" placeholder="请输入顾客名称" data-style="mb:7">
                                <strong><?php echo $customerErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品名称</td>
                            <td>
                                <input class="control rounded" type="text" name="goodsname" placeholder="请输入所购商品名称" data-style="mb:7">
                                <strong><?php echo $goodsErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品数量</td>
                            <td>
                                <input class="control rounded" type="text" name="ordernum" placeholder="请输入购买的数量" data-style="mb:7">
                                <strong><?php echo $numErr;?></strong>
                            </td>
                        </tr>
                         <tr>
                            <td>联系电话</td>
                            <td>
                                <input class="control rounded" type="text" name="tel" placeholder="请输入顾客联系电话" data-style="mb:7">
                                <strong><?php echo $telErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>收货地址</td>
                            <td>
                                <input class="control rounded" type="text" name="address" placeholder="请输入有效的收货地址" data-style="mb:7">
                                <strong><?php echo $addErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <td>
                                    <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">添加订单</button>
                                </td>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
