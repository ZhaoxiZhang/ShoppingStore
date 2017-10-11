<?php 
require_once 'include_func.php';

check_admin_status();
$url = htmlspecialchars($_SERVER["PHP_SELF"]).'?'.$_SERVER["QUERY_STRING"];
//echo $url.'<br/>';


$adminid = $_GET['adminid'];

$query = "select * from admin where adminid = '{$adminid}'";

$result = get_admin($query);


$nameErr = $pwdErr = $emailErr = null;
$name = $pwd = $email = null;

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
	$ans['password'] = sha1($_POST['password']);
	$result = update("admin",$ans,"adminid='{$adminid}'");
	if ($result)
	{
		do_url('list_admin.php','管理员信息成功，查看管理员列表');
	}
	else
	{
		do_url('list_admin.php','管理员信息更新失败，重新编辑');
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
    <?php $result = get_admin($query);?>
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 编辑管理员信息">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>管理员名称</td>
                            <td>
                                <input class="control material blue" type="text" name="username" placeholder="<?php echo $result['username'];?>" />
                            	<strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>管理员密码</td>
                            <td>
                                <input class="control material blue" type="password" name="password" value="<?php echo $result['password'];?>" />
                            	<strong><?php echo $pwdErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>管理员邮箱</td>
                            <td>
                                <input class="control material blue" type="text" name="email" placeholder="<?php echo $result['email'];?>" />
                            	<strong><?php echo $emailErr; ?></strong>
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

