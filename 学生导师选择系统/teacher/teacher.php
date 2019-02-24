<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
	<title>教师端</title>
	<style type="text/css">
	.t{
		position: relative;
		left: 20%;
		margin-left: 200px;
	}
	body{
		background-color: lightgray;
	}
	.p{
		position: relative;
		left: 400px;
		top: -54px;
	}
	h1{
		position: relative;
		font-size: 100px;
		margin-left: 500px;
		top: 100px;
	}
	.c{
		display:block;
		position: relative;
		margin-top: 50px;
		top: 150px;
		left: 550px;
		width: 300px;
		height: 80px;
	}
</style>
</head>
<body>
	<?php
	session_start();
	//更改密码
	if(isset($_POST['Pchange'])){
		header("location:../PasswordChange.php");
	}
	//选择学生
	if(isset($_POST['con'])){
		header("location:confirm.php");
	}
	//查看已经选定的学生
	if(isset($_POST['ppap'])){
		header("location:allStu.php");
	}
	//退出
	if(isset($_POST['logOut'])){
		$_SESSION=array();
		session_destroy();
		header("location:../index.html");
	}
	?>
<nav class="navbar navbar-default navbar-inverse">
		<!-- 导航栏 -->
		<div class="container-fluid">
			<div class="navbar-header">
				<span><h2 style="color:white;">欢迎,<?php echo $_SESSION["username"]; ?>老师!</h2></span>
			</div>
			<form class="navbar-form navbar-right" role="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  				<button type="submit" class="btn btn-default btn-success" value="登出" name="logOut" style="margin-top: 8px;">退出</button>
			</form>
		</div>
	</nav>
	<h1>请问您要？</h1>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="submit" name="con" value="查看等待我确认的学生" class="btn btn-info c">
		<input type="submit" name="ppap" value="查看我已选定的学生" class="btn btn-info c">
		<input type="submit" name="Pchange" value="更改密码" class="btn btn-info c">
	</form>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="/..js/bootstrap.min.js"></script>
</body>
</html>