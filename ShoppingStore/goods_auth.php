<?php
require_once 'include_func.php';


function add_goods()
{
	$ans = $_POST;
	$ans['pubtime'] = time();
	$query = insert("goods",$ans);
	if ($query)	return true;
	else return false;
}

function get_goods_list($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	 return $result;
}

function get_goods($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	return $result->fetch_assoc();
}

function edit_goods($goodsid,$goodscatename)
{
	$ans = $_POST;
	
	$query = "select catid from categories where catname = '{$goodscatename}';";
	//echo $query.'<br/>';
	$res = get_categories($query);
	
	$ans['catid'] = $res['catid'];
	
	//print_r($ans);
	
	$result = update("goods",$ans,"goodsid='{$goodsid}'");
	
	if ($result)	return true;
	else	return false;
}

function del_goods($goodsid)
{
	$result = delete("goods","goodsid='{$goodsid}'");
	if ($result)	return true;
	else	return false;
}


?>