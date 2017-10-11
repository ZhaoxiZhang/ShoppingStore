<?php
require_once 'include_func.php';

check_admin_status();
$url = htmlspecialchars($_SERVER["PHP_SELF"]).'?'.$_SERVER["QUERY_STRING"];


$goodsid = $_GET['goodsid'];
$query = "select * from goods where goodsid = '{$goodsid}'";
$result = get_goods($query);
$goodssn = $result['goodssn'];
$catelist = get_categories_list();



$nameErr = $snErr = $numErr = $orignErr = $currentErr = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	
	if (empty($_POST['goodsname']))
	{
		$nameErr = "商品名称字段必填";
	}
	else
	{
		$query = "select * from goods where goodsname = '{$_POST['goodsname']}';";
		$res = get_goods_list($query);
		$num_goods = @$res->num_rows;
		if ($num_goods == 1)
		{
			$res = get_goods($query);
			if ($res['goodsid'] != $goodsid)
			{
				$nameErr = "此商品已经添加";
			}
		}
	}
	
	if (empty($_POST['goodssn']))
	{
		$snErr = "商品货号字段必填";
	}
	else
	{
		if (!is_numeric($_POST['goodssn']))
		{
			$snErr = "输入的商品货号字段非法";
		}
		else
		{
			$query = "select * from goods where goodssn = '{$_POST['goodssn']}';";
			$res = get_goods_list($query);
			$num_goods = @$res->num_rows;
			if ($num_goods == 1)
			{
				$res = get_goods($query);
				if ($res['goodssn'] != $goodssn)
				{
					$nameErr = "此商品已经添加";
				}
			}
		}
	}
	
	if (empty($_POST['goodsnum']))
	{
		$numErr = "商品数量字段必填";
	}
	else
	{
		if (!is_numeric($_POST['goodsnum']))
		{
			$numErr = "输入的商品数量字段非法";
		}
	}
	
	if (empty($_POST['originprice']))
	{
		$orignErr = "商品原价字段必填";
	}
	else
	{
		if (!is_numeric($_POST['originprice']))
		{
			$orignErr = "商品原价字段非法";
		}
		elseif ($_POST['originprice'] <= 0)
		{
			$orignErr = "输入的商品原价不符合盈利要求";
		}
		
	}
	
	if (empty($_POST['currentprice']))
	{
		$currentErr = "商品现价字段必填";
	}
	else
	{
		if (!is_numeric($_POST['currentprice']))
		{
			$currentErr = "商品现价字段非法";
		}
		elseif ($_POST['currentprice'] <= 0)
		{
			$currentErr = "输入的商品现价不符合盈利要求";
		}
	}
}

if (!empty($_POST) && $nameErr == null && $snErr == null && $numErr == null && $orignErr == null && $currentErr == null)
{
	
	$ans = $_POST;
	
	if (isset($_POST['catid']))
	{
		$goodscatename = $_POST['catid'];
	}
	else
	{
		$goodscatename = null;
	}
	
	$query = "select catid from categories where catname = '{$goodscatename}';";
	$res = get_categories($query);
	
	$ans['catid'] = $res['catid'];
	
	$result = update("goods",$ans,"goodsid='{$goodsid}'");
	
	if ($result)
	{
		do_url('list_goods.php','编辑成功，查看商品列表');
	}
	else
	{
		do_url('list_goods.php','编辑失败，重新编辑');
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
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
</head>

<body>
    <form action="<?php echo $url;?>" method="post">
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 编辑商品">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>商品名称</td>
                            <td>
                                <input type="text" name="goodsname" placeholder="<?php echo "初值为：".$result['goodsname'];?>"/>
                            	<strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                        	<td>商品货号</td>
                        	<td>
                        		<input type="text" name="goodssn" placeholder="<?php echo "初值为：".$result['goodssn'];?>" />
                        		<strong><?php echo $snErr;?></strong>
                        	</td>
                        </tr>
                        <tr>
                        	<td>商品分类</td>
                        	<td>
                        		<select name="catid">
                        			<?php foreach($catelist as $row):?>
                        			<option values="<?php echo $row['catid'];?>">
                        				<?php echo $row['catname'];?>
                        			</option>
                        			<?php endforeach;?>
                        		</select>
                        	</td>
                        </tr>
                        <tr>
                            <td>商品数量</td>
                            <td>
                                <input type="text" name="goodsnum" placeholder="<?php echo "初值为：".$result['goodsnum'];?>" />
                            	<strong><?php echo $numErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品原价</td>
                            <td>
                                <input type="text" name="originprice" placeholder="<?php echo "初值为：".$result['originprice'];?>" />
                            	<strong><?php echo $orignErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品现价</td>
                            <td>
                                <input type="text" name="currentprice" placeholder="<?php echo "初值为：".$result['currentprice'];?>" />
                            	<strong><?php echo $currentErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品描述</td>
                            <td>
                                <textarea id="editor_id" style="width:100%;height:150px;" name="description" ><?php echo $result['description'];?> </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <td>
                                    <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">提交</button>
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
