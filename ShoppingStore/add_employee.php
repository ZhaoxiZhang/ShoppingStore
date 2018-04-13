<?php 
require_once 'include_func.php';

check_admin_status();


//表单验证
$nameErr = $sexErr = $posErr = $telErr = $emailErr= null;
$eamil = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if (empty($_POST['employeename']))
	{
		$nameErr = "名称字段不能为空";
	}
	
	if (empty($_POST['sex']))
	{
		$sexErr = "请选择员工性别";
	}
	
	if (empty($_POST['position']))
	{
		$posErr = "职位字段不能为空";
	}
	
	if (empty($_POST['tel']))
	{
		$telErr = "电话字段不能为空";
	}
	else
	{
		if (!is_numeric($_POST['tel']))
		{
			$telErr = "联系电话字段不合法";
		}
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

if (!empty($_POST) && $nameErr == null && $sexErr == null && $posErr == null && $telErr == null && $emailErr == null)
{
	$ans = $_POST;
	
	if ($ans['sex'] == 1)
	{
		$ans['sex'] = "男";
	}
	elseif ($ans['sex'] == 2)
	{
		$ans['sex'] = "女";
	}
	
	$ans['entrytime'] = time();
	$result = insert("employee",$ans);
	
	if ($result)
	{
		do_url('list_employee.php','添加成功，查看员工列表');
		echo '<br/>';
		do_url('add_employee.php','添加成功，继续添加');
	}
	else
	{
		do_url('add_employee.php','添加失败，重新添加');
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
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 添加员工">
            <div class="row">
                <div class="panel white">
                    <table class="table">
                        <tr>
                            <td>员工姓名</td>
                            <td>
                                <input class="control rounded" type="text" name="employeename" placeholder="请输入员工姓名" data-style="mb:7">
                                <strong><?php echo $nameErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                        	<td>性别</td>
                        	<td>
                        		<input type="radio" id="r4" value="1" class="control grey block" name="sex" />
								<label for="r4"><span></span>男</label>
								<input type="radio" id="r5" value="2" class="control lightgrey block" name="sex" />
								<label for="r5"><span></span>女</label>
								<strong><?php echo $sexErr;?></strong>
                        	</td>
                        </tr>
                        <tr>
                            <td>职位</td>
                            <td>
                                <input class="control rounded" type="text" name="position" placeholder="请输入员工职位" data-style="mb:7">
                                <strong><?php echo $posErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                        	<td>电话号码</td>
                        	<td>
                        		<input class="control rounded" type="text" name="tel" placeholder="请输入员工联系方式" data-style="mb:7">
                        		<strong><?php echo $telErr;?></strong>
                        	</td>
                        </tr>
                        <tr>
                            <td>电子邮箱</td>
                            <td>
                                <input class="control rounded" type="text" name="email" placeholder="请输入员工邮箱" data-style="mb:7">
                                <strong><?php echo $emailErr;?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <td>
                                    <button class="control border default block rounded hover-inverse" data-style="mt:15" type="submit">添加员工</button>
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
