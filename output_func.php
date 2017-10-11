<?php
function alert_message($mes, $url)
{
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location='{$url}';</script>";
}


function do_url($url, $name)
{
	?>
<a href="<?php echo $url; ?>"><?php echo $name; ?></a>
<br />

<?php
}

function do_input($data)
{
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

?>