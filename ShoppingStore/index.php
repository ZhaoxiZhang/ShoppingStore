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

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/framework.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body class="st-no-select">
    <div class="navbar">
        <a class="sidebar-toggle"></a>
        <a class="second-navbar-toggle"></a>
        <div class="navbar-options">
            <ul>
                <li>
                    <a id="btn-fullscreen" href="#"><i class="fa fa-arrows-alt"></i></a>
                </li>
                <li>
                    <a>
                        <span> <?php if (isset($_SESSION['admin_user']))
                                {
                                    echo $_SESSION['admin_user'];
                                    echo '<ul>';
                                    echo    '<a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>';
                                    echo '</ul>';

                                }
                                ?></span>
                    </a>
                </li>
           </ul>
        </div>
    </div>
    
    <div class="content-container">
    	<div><br/></div>
		<div class="content mg-left-90">
             <div class="page-header mg-left-5">
				  <div class="h3 ">后台管理</div>
			 </div>
        </div>    
    	<div class="mg-left-90">
     		<iframe src="main.php" frameborder="0" name="mainFrame" width="100%" height="580"></iframe>
    	</div>
    
        <div class="sidebar">
            <div class="sidebar-top">
                <span class="sidebar-title"><a href="index.php">Main Menu</a></span>
                <a class="sidebar-toggle"></a>
            </div>
            <div class="sidebar-content">
                <ul>
                 	<li>
                        <a href="#"><i class="fa fa-reorder"></i> <span>分类管理</span></a>
                        <ul>
                            <li><a href="add_categories.php" target="mainFrame">添加分类</a></li>
                            <li><a href="list_categories.php" target="mainFrame">分类列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-reorder"></i> <span>商品管理</span></a>
                        <ul>
                            <li><a href="add_goods.php" target="mainFrame">添加商品</a></li>
                            <li><a href="list_goods.php" target="mainFrame">商品列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-reorder"></i> <span>订单管理</span></a>
                        <ul>
                            <li><a href="add_orders.php" target="mainFrame">添加订单</a></li>
                            <li><a href="list_orders.php" target="mainFrame">订单列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-reorder"></i> <span>管理员管理</span></a>
                        <ul>
                            <li><a href="add_admin.php" target="mainFrame">添加管理员</a></li>
                            <li><a href="list_admin.php" target="mainFrame">管理员列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-reorder"></i> <span>员工管理</span></a>
                        <ul>
                            <li><a href="add_employee.php" target="mainFrame">添加员工</a></li>
                            <li><a href="list_employee.php" target="mainFrame">员工列表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>   
        <script type="text/javascript" src="js/styleDemo.js"></script>
</body>

</html>
