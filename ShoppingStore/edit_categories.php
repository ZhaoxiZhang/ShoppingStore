<?php
require_once 'include_func.php';

check_admin_status();

$url = htmlspecialchars($_SERVER["PHP_SELF"]).'?'.$_SERVER["QUERY_STRING"];

$catid = $_GET['catid'];

$query = "select * from categories where catid = '{$catid}'";

$result = get_categories($query);

$nameErr = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['catname']))
	{
		$nameErr = "分类名称字段必填";
	}
	else
	{
		$where = "catname = '{$_POST['catname']}'";
		$query = get_categories_list($where);
		$num_cate = @$query->num_rows;
		if ($num_cate != 0)
		{
			$nameErr = "此分类已经添加，请重新输入";
		}
	}
}

if (!empty($_POST) && $nameErr == null)
{
	$ans = $_POST;
	$result = update("categories",$ans," catid='{$catid}' ");
	if ($result)
	{
		do_url('list_categories.php','编辑成功，查看分类列表');
	}
	else
	{
		do_url('list_categories.php','编辑失败，重新编辑');
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

<body class="pd-bottom-100">
    <form action="<?php echo $url;?>" method="post">
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 修改分类信息">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>分类名称</td>
                            <td>
                                <input class="control material blue" type="text" name="catname" placeholder="<?php echo $result['catname'];?>" />
                                <strong><?php echo $nameErr;?></strong>
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
