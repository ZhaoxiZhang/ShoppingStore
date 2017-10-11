<?php

require_once 'include_func.php';


function add_categories()
{
	$ans = $_POST;
	$query = insert("categories",$ans);
	if ($query)	return true;
	else return false;
}

function get_categories_list($where = null)
{
	$where = $where == null?null : "where {$where}";
	$conn = db_connect();
	$query = "select * from categories {$where} order by catid";
	
	$result = $conn->query($query);
	
	if (!$result)	return false;
	else	 return $result;
}

function get_categories($query)
{
	$conn = db_connect();
	$result = @$conn->query($query);
	if (!$result)	return false;
	else	return $result->fetch_assoc();
}

function edit_categories($catid)
{
	$ans = $_POST;
	$result = update("categories",$ans," catid='{$catid}' ");
	if ($result)	return true;
	else	return false;
}

function del_categories($catid)
{
	$result = delete("categories","catid='{$catid}'");
	if ($result)	return true;
	else	return false;
}

?>