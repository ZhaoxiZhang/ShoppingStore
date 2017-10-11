<?php 
require_once 'include_func.php';

check_admin_status();

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
		$result = get_categories_list($where);
		$num_cate = @$result->num_rows;
		if ($num_cate != 0)
		{
			$nameErr = "此分类已经添加，无需重复添加";
		}
	}
	
}


if (!empty($_POST) && $nameErr == null)
{
	
	$ans = $_POST;
	$query = insert("categories",$ans);
	if ($query)
	{
		do_url('list_categories.php','添加分类成功，查看分类列表');
		echo '<br/>';
		do_url('add_categories.php','添加分类成功，继续添加');
	}
	else
	{
		do_url('add_categories.php','添加分类失败，重新添加');
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 添加分类">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover">
                        <tr>
                            <td>分类名称</td>
                            <td>
                                <input class="control rounded" type="text" name="catname" placeholder="请输入分类名称" data-style="mb:7">
                                <strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <td>
                                    <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">添加分类</button>
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
