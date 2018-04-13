<?php
require_once 'include_func.php';

check_admin_status();

$rows = get_order_list();
$num_order = @$rows->num_rows;
if ($num_order == 0)
{
	alert_message("订单列表为空，请先添加订单","add_orders.php");
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
    		function add_order() 
    		{
    			window.location = "add_orders.php";
    		}

    		function edit_order(id) 
    		{
        		window.location = "edit_order.php?orderid=" + id;
			}

    		function del_order(id)
    		{
    			var msg = confirm("您确定要删除吗？删除后无法恢复！");
    			if (msg == true)
    			{
    				window.location="do_order_action.php?act=delorder&orderid="+id;
    			}
    		}
    	</script>
    </head>

    <body>
    	<div class="pd-bottom-100">
    	<div class="details_operation clearfix">
             <div class="bui_select">
                  <input type="button" value="添加订单" class="add" onclick="add_order()">
             </div>
        </div>
        <div><br/></div>
        <div class="content">
            <div class="panel light-shadow white title-transparent rounded" data-title="<i class='fa fa-circle' ></i> 订单列表">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel white">
                            <table class="table table-hover table-hover-td">
                                <thead>
                                    <tr>
                                        <th>订单编号</th>
                                        <th>顾客姓名</th>
                                        <th>商品名称</th>
                                        <th>商品数量</th>
                                        <th>联系电话</th>
                                        <th>下单时间</th>
                                        <th>总价</th>
                                        <th>收货地址</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach($rows as $row):?>
                                    <tr>
                                        <td>
                                            <?php echo $row['orderid'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['customername'];?>
                                        </td>
                                        <td>
                                        	<?php 
                                        		$goodsid = $row['goodsid'];
                                        		$query = "select * from goods where goodsid = '{$goodsid}';";
                                        		$result = get_goods($query);
                                        		echo $result['goodsname'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['ordernum'];?>
                                        </td>
                                        <td>
                                        	<?php echo $row['tel'];?>
                                        </td>
                                        <td>
                                        	<?php echo date('Y-m-d,H:i:s',$row['ordertime'])?>
                                        </td>
                                        <td>
                                        	<?php echo "￥".$row['amount'];?>
                                        </td>
                                        <td>
                                        	<?php echo $row['address']?>
                                        </td>
                                        <td align="center">
                                            <input type="button" value="修改" class="btn" onclick="edit_order(<?php echo $row['orderid'];?>)">
                                            <input type="button" value="删除" class="btn" onclick="del_order(<?php echo $row['orderid'];?>)">
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
