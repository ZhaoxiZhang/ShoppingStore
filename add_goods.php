<?php
require_once 'include_func.php';

check_admin_status();

$result = get_categories_list();
$num_categories = $result->num_rows;
if($num_categories == 0)
{
	alert_message("还没有分类，请先添加分类!", "add_categories.php");
}

$nameErr = $snErr = $numErr = $orignErr = $currentErr = null;

$url = htmlspecialchars($_SERVER["PHP_SELF"]);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['goodsname']))
	{
		$nameErr = "商品名称字段必填";
	}
	else
	{
		$query = "select * from goods where goodsname = '{$_POST['goodsname']}';";
		$result = get_goods_list($query);
		$num_goods = @$result->num_rows;
		if ($num_goods != 0)
		{
			$nameErr = "此商品已经添加";
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
	$ans['pubtime'] = time();
	$query = insert("goods",$ans);
	if ($query)
	{
		do_url('list_goods.php','添加成功，查看商品列表');
		echo '<br/>';
		do_url('add_goods.php','添加成功，继续添加');
	}
	else
	{
		do_url('add_goods.php','添加失败，重新添加');
	}
	exit();
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Welcome</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/framework-all.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/framework.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
</head>

<body>
<?php 
$result = get_categories_list();
?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <div class="panel light-shadow white title-transparent rounded" data-title="&lt;i class='fa fa-circle'&gt;&lt;/i&gt; 请添加商品信息">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>商品名称</td>
                            <td>
                                <input class="control rounded" type="text" name="goodsname" placeholder="请输入商品名称" data-style="mb:7" />
                                <strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品分类</td>
                            <td>
                                <select name="catid">
                                    <?php foreach($result as $row):?>
                                    <option value="<?php echo $row['catid'];?>">
                                        <?php echo $row['catname'];?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>商品货号</td>
                            <td>
                                <input class="control rounded" type="text" name="goodssn" placeholder="请输入商品货号" data-style="mb:7" />
                                <strong><?php echo $snErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品数量</td>
                            <td>
                                <input class="control rounded" type="text" name="goodsnum" placeholder="请输入商品数量" data-style="mb:7" />
                                <strong><?php echo $numErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品原价</td>
                            <td>
                                <input class="control rounded" type="text" name="originprice" placeholder="请输入商品市场价" data-style="mb:7" />
                                <strong><?php echo $orignErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>商品现价</td>
                            <td>
                                <input class="control rounded" type="text" name="currentprice" placeholder="请输入商品现价" data-style="mb:7" />
                                <strong><?php echo $currentErr;?></storng>
                            </td>
                        </tr>
                        <tr>
                            <td>商品描述</td>
                            <td>
                                <textarea name="description" id="editor_id" style="width:100%;height:150px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">发布商品</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
