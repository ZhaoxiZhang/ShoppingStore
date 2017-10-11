<?php
require_once 'include_func.php';

function add_order()
{
	$ans = $_POST;
	
	$goodsname = $ans['goodsname'];
	$query = "select * from goods where goodsname = '{$goodsname}';";
	$result = get_goods($query);
	
	$ans['goodsid'] = $result['goodsid'];
	$ans['amount'] = $ans['ordernum']*$result['currentprice'];
	$ans['ordertime'] = time();
	
	$tmp = array();
	$tmp['goodsname'] = $ans['goodsname']; 
	$ans = array_merge(array_diff($ans, $tmp));
	
	$query = insert("orders",$ans);
	if ($query)	return true;
	else return false;
}

function get_order_list()
{
	$conn = db_connect();
	$query = "select * from orders order by orderid";
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	 return $result;
}

function get_order($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	return $result->fetch_assoc();
}

function edit_order($orderid)
{
	$ans = $_POST;
	$result = update("orders",$ans,"orderid='{$orderid}'");
	if ($result)	return true;
	else	return false;
}

function del_order($orderid)
{
	$result = delete("orders","orderid='{$orderid}'");
	if ($result)	return true;
	else	return false;
}

?>