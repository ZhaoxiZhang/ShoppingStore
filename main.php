<?php 
require_once 'include_func.php';

check_admin_status();

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
    <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 实验环境">
        <div class="row">
            <div class="col-md-12">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <th>操作系统</th>
                            <td>
                                <?php echo PHP_OS;?>
                            </td>
                        </tr>
                        <tr>
                            <th>Apache版本</th>
                            <td>
                                <?php echo apache_get_version();?>
                            </td>
                        </tr>
                        <tr>
                            <th>PHP版本</th>
                            <td>
                                <?php echo PHP_VERSION;?>
                            </td>
                        </tr>
                        <tr>
                            <th>运行方式</th>
                            <td>
                                <?php echo PHP_SAPI;?>
                            </td>
                        </tr>
                        <!-- 以下信息来自我的实验环境 -->
                        <!--操作系统：WINNT  -->
                        <!--Apache版本：Apache/2.4.23（Win64） PHP/5.6.25 -->
                        <!--PHP版本：5.6.25 -->
                        <!--运行方式：apache2handler -->
                    </table>
                </div>
            </div>
        </div>
	</div>
	<div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 系统信息">
         <div class="row">
            <div class="col-md-12">
                <div class="panel white">
                    <table class="table table-hover table-hover-td">
                        <tr>
                            <th>系统名称</th>
                            <td>小型电子商务后台管理系统</td>
                        </tr>
                        <tr>
                        	<th>系统功能</th>
                        	<td>实现简单的商品分类、商品信息、订单、员工、管理员的增删改查</td>
                        </tr>
                        <tr>
                            <th>开发团队</th>
                            <td>张昭锡</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
