<?php 

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PWD","N4G2GuC0OkrvmrR3");
define("DB_DBNAME","shopping_mall");

function db_connect()
{
	$result = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
	if (! $result)
	{
		throw new Exception ("无法连接数据库服务！");
	}
	else
	{
		
		$result->autocommit(true);
		return $result;
	}
}

function db_result_to_array($result)
{
	$res_array = array();
	
	for ($i = 0;$row = $result->fetch_assoc();$i++)
	{
		$res_array[$i] = $row;
	}
	
	return $res_array;
}

function insert($table,$array)
{
	$conn = db_connect();
	$key = "".join(",",array_keys($array));
	$val = "'".join("','",array_values($array));
	$query = "insert into {$table}({$key})VALUES({$val}');";
	
	//echo $query.'<br/>';
	
	$result = $conn->query($query);
	if ($result)	return true;
	else	return false;
}

function update($table,$array,$where = null)
{
	$conn = db_connect();
	$str = "";
	$where = $where == null ? null : "where {$where}";
	
	//echo '$where'.'<br/>';
	
	foreach($array as $key => $val)
	{
		if ($str == null)	$tmp = "";
		else	$tmp = ",";
		$str .= $tmp . $key . "='" . $val ."'";
	}
	$query = "update {$table} set {$str} {$where};";
	
	//echo $query.'<br />';
	
	$result = $conn->query($query);
	if ($result)	return true;
	else	return false;
}

function delete($table,$where = null)
{
	$conn = db_connect();
	$where = $where == null ? null : " where ". $where;
	$query = "delete from {$table}{$where};";
	
	$result = $conn->query($query);
	if (!$result)	return false;
	else	return true;
}

?>