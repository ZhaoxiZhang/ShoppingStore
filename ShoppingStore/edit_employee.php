<?php
require_once 'include_func.php';

check_admin_status();

$employeeid = $_GET['employeeid'];
$query = "select * from employee where employeeid = '{$employeeid}'";

$result = get_employee($query);


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
	$result = update("employee",$ans,"employeeid='{$employeeid}'");
	if ($result)
	{
		do_url('list_employee.php','编辑成功，查看员工列表');
	}
	else
	{
		do_url('list_employee.php','编辑失败，重新编辑');
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

<body class="pd-bottom-90">
    <form action="do_employee_action.php?act=editemployee&employeeid=<?php echo $employeeid;?>" method="post">
        <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 编辑员工信息">
            <div class="row">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <td>员工名称</td>
                            <td>
                                <input class="control material blue" type="text" name="employeename" placeholder="初值为：<?php echo $result['employeename'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>员工职位</td>
                            <td>
                                <input class="control material blue" type="text" name="position" placeholder="初值为：<?php echo $result['position'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>员工邮箱</td>
                            <td>
                                <input class="control material blue" type="text" name="email" placeholder="初值为：<?php echo $result['email'];?>" />
                            </td>
                        </tr>
                        <tr>
                        	<td>员工电话</td>
                        	<td>
                        		<input class="control material blue" type="text" name="tel" placeholder="初值为：<?php echo $result['tel'];?>" />
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
