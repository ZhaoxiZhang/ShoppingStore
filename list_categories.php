<?php
require_once 'include_func.php';

check_admin_status();

$rows = get_categories_list();
$num_cate = @$rows->num_rows;
if ($num_cate == 0)
{
	alert_message("分类列表为空，请先添加分类","add_categories.php");
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
    <script type="text/javascript">
		function add_categories() 
		{
		    window.location = "add_categories.php";
		}
		
		function edit_categories(id) 
		{
		    window.location = "edit_categories.php?catid=" + id;
		}
		
		function del_categories(id) 
		{
			var msg = confirm("您确定要删除吗？删除后无法恢复！");
		    if (msg == true) 
		    {
		        window.location = "do_categories_action.php?act=delcate&catid=" + id;
		    }
		}
	</script>
</head>

<body>
    <div class="pd-bottom-100">
        <div class="details_operation clearfix">
            <div class="bui_select">
                <input type="button" value="添加商品分类" class="add" onclick="add_categories()">
            </div>
        </div>
        <div>
            <br/>
        </div>
        <div class="content">
            <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle' ></i> 分类列表">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel white">
                            <table class="table table-hover table-hover-td">
                                <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>分类名称</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach($rows as $row):?>
                                    <tr>
                                        <td>
                                            <?php echo $row['catid'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['catname'];?>
                                        </td>
                                        <td align="center">
                                            <input type="button" value="修改" class="btn" onclick="edit_categories(<?php echo $row['catid'];?>)">
                                            <input type="button" value="删除" class="btn" onclick="del_categories(<?php echo $row['catid'];?>)">
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
</body>
</html>
