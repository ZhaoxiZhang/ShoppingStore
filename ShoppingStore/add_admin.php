<?php 
require_once 'include_func.php';

check_admin_status();


$nameErr = $pwdErr = $emailErr = null;
$email = null;


if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['username']))
	{
		$nameErr = "名称字段必填";
	}
	else
	{
		$where = "username = '{$_POST['username']}'";
		$result = get_admin_list($where);
		$num_admin = @$result->num_rows;
		if ($num_admin != 0)
		{
			$nameErr = "此名称已被占用，请重新输入";
		}
	}
	
	if (empty($_POST['password']))
	{
		$pwdErr = "密码字段必填";
	}
	
	if (empty($_POST['email']))
	{
		$emailErr = "邮箱字段必填";
	}
	else
	{
		$email = do_input($_POST['email']);
		
		if (!preg_match ("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
		{
			$emailErr = "无效的邮件格式";
		}
	}
}


if (!empty($_POST) && $nameErr == null && $pwdErr == null && $emailErr == null)
{
		$ans = $_POST;
		$query = insert("admin",$ans);
		if ($query)
			{
				do_url('list_admin.php','添加成功，查看管理员列表');
				echo '<br/>';
				do_url('add_admin.php','添加成功，继续添加');
			}
		else
			{
				do_url('add_admin.php','添加失败，重新添加');
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
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 添加管理员">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover">
                        <tr>
                            <td>管理员名称</td>
                            <td>
                                <input class="control rounded" type="text" name="username" placeholder="请输入管理员名称" data-style="mb:7">
                                <strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>管理员密码</td>
                            <td>
                                <input class="control rounded" type="password" name="password" placeholder="请输入管理员密码" data-style="mb:7">
                                <strong><?php echo $pwdErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>管理员邮箱</td>
                            <td>
                                <input class="control rounded" type="text" name="email" placeholder="请输入管理员邮箱" data-style="mb:7">
                                <strong><?php echo $emailErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <td>
                                    <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">添加管理员</button>
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
