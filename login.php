<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Login</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/framework-all.css">
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/framework.js"></script>
</head>

<body class="" data-style="bg:#1F2C36" style="overflow:auto; height:100%">
    <div class="panel white rounded centered form">
        <h1 class="txt-center">LOGIN</h1>
        <form action="dologin.php" method="post">
            <input class="control rounded" type="text" name="username" placeholder="Username" data-style="mb:7">
            <input class="control rounded" type="password" name="password" placeholder="Password" data-style="mb:7">
            <button class="control border default block rounded hover-inverse" type="submit" data-style="mt:15">Login to my account</button>
        </form>
    </div>
</body>

</html>
