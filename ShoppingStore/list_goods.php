<?php
require_once 'include_func.php';

check_admin_status();

if (isset($_GET['keywords']))
{
	$keywords = $_GET['keywords'];
}
else
{
	$keywords = null;
}

$where = $keywords?"where g.goodsname like '%{$keywords}%'":null;

$query="select g.goodsid,g.goodsname,g.goodssn,g.goodsnum,g.originprice,g.currentprice,g.description,g.pubtime,g.isshow,c.catname 
from goods as g join categories c on g.catid=c.catid {$where} order by g.goodsid";
$rows = get_goods_list($query);

$num_goods = @$rows->num_rows;

if ($num_goods == 0)
{
	if (!isset($_GET['keywords']))
	{
		alert_message("商品列表为空，请先添加商品","add_goods.php");
		exit();
	}
	else
	{
		do_url("list_goods.php", "没有该商品，返回商品列表");
		exit();
	}
	
}

$rows = db_result_to_array($rows);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="css/framework-all.css">
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/framework.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function add_goods()
        {
            window.location = "add_goods.php";
        }

        function edit_goods(id)
        {
            window.location = "edit_goods.php?goodsid=" + id;
        }

        function del_goods(id) 
        {
            var msg = confirm("您确认要删除嘛？删除后不可恢复!");
            if (msg == true) 
            {
                window.location = "do_goods_action.php?act=delgoods&goodsid=" + id;
            }
        }

        function entersearch()
    	{
    		if (event.keyCode == 13)
    		{
    			var val = document.getElementById("search").value;
    			window.location = "list_goods.php?keywords="+val;
    		}
    	}

        function clicksearch()
        {
        	var val = document.getElementById("search").value;
        	window.location = "list_goods.php?keywords="+val;
        }
    	
			
        function change(val) 
        {
            window.location = "list_goods.php?order=" + val;
        }
    </script>
   
</head>

<body>
    <div class="pd-bottom-100">
        <div class="pd-bottom-100">
            <div>
                <input type="button" value="添加商品" class="add" onclick="add_goods()">
                <div class="navbar-search">
                        <input type="text" value="" id="search" placeholder="Search"  onkeypress="entersearch()"><span id="search" onclick="clicksearch()"></span>
                </div>
            <div>
            
            <div>
                <br/>
            </div>
            <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle'></i> 商品列表">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel white">
                            <table class="table table-hover table-hover-td">
                                <thead>
                                    <tr>
                                        <th ">编号</th>
                                            <th>商品名称</th>
                                            <th>商品分类</th>
                                            <th>是否上架</th>
                                            <th>上架时间</th>
                                            <th>原价</th>
                                            <th>现价</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ((array)$rows as $row):?>
                                        <tr>
                                            <td>
                                                <?php echo $row['goodsid'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['goodsname'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['catname'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['isshow']==1?"上架 ":"下架 ";?>
                                            </td>
                                            <td>
                                                <?php echo date("Y-m-d H:i:s ",$row['pubtime']);?>
                                            </td>
                                            <td>
                                            	<?php echo '￥'.$row['originprice'];?>
                                            </td>
                                            <td>
                                                <?php echo '￥'.$row['currentprice'];?>
                                            </td>
                                            <td align="center ">
                                            	<input type="button" value="修改" class="btn" onclick="edit_goods(<?php echo $row['goodsid'];?>)">
                                            	<input type="button" value="删除" class="btn" onclick="del_goods(<?php echo $row['goodsid'];?>)">
                                            </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

 

</html>
