<?php
require_once 'include_func.php';

check_admin_status();

date_default_timezone_set("Asia/Shanghai");

$rows = get_employee_list();
$num_employee = @$rows->num_rows;
if ($num_employee == 0)
{
	alert_message("员工列表为空，请先添加用户","add_employee.php");
	exit();
}

$rows = db_result_to_array($rows);

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
        <script type="text/javascript">
    		function add_employee() 
    		{
        		window.location = "add_employee.php";
   	 		}

    		function edit_employee(id) 
    		{
    			window.location = "edit_employee.php?employeeid=" + id;
    		}

    		function del_employee(id) 
    		{
    			var msg = confirm("您确认要删除嘛？删除后不可恢复!");
    			if (msg == true) 
    			{
    				window.location = "do_employee_action.php?act=delemployee&employeeid=" + id;
    			}
    		}
    	</script>
    </head>

    <body>
    	<div class="pd-bottom-100">
        <div class="details_operation clearfix">
            <div class="details_operation clearfix">
                <div class="bui_select">
                    <input type="button" value="添加员工" class="add" onclick="add_employee()">
                </div>
                
            </div>
            <div><br/></div>
            <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 员工列表">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel white">
                            <table class="table table-hover table-hover-td">
                                <thead>
                                    <tr>
                                        <th>员工编号</th>
                                        <th>员工名称</th>
                                        <th>员工性别</th>
                                        <th>员工职位</th>
                                        <th>员工邮箱</th>
                                        <th>员工电话</th>
                                        <th>入职时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  foreach($rows as $row):?>
                                <tr>
                                    <td>
                                        <?php echo $row['employeeid'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['employeename'];?>
                                    </td>
                                    <td>
                                    	<?php echo $row['sex'];?>
                                    </td>
                                    <td>
                                    	<?php echo $row['position'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['email'];?>
                                    </td>
                                    <td>
                                    	<?php echo $row['tel'];?>
                                    </td>
                                    <td>
                                    	<?php echo  date('Y-m-d H:i:s',$row['entrytime']);;?>
                                    </td>
                                    <td align="center ">
                                        <input type="button" value="修改 " class="btn " onclick="edit_employee(<?php echo $row[ 'employeeid'];?>)">
                                        <input type="button" value="删除" class="btn" onclick="del_employee(<?php echo $row['employeeid'];?>)">
                                	</td>
                                   </tr>
                                   <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
