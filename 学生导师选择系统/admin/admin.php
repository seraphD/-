<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>管理员端</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<meta charset="utf-8">
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
	//退出
	if(isset($_POST['logOut'])){
		session_destroy();
		$_SESSION=array();
		header("location:../index.html");
	}
	//更改密码
	if(isset($_POST['change'])){
		header("location:../PasswordChange.php");
	}
	//查询学生
	if(isset($_POST['selectS'])){
		header("location:checkStudent.php");
	}
	//查询导师
	if(isset($_POST['selectT'])){
		header("location:checkTutor.php");
	}
	?>
<nav class="navbar navbar-default navbar-inverse">
		<!-- 导航栏 -->
		<div class="container-fluid">
			<div class="navbar-header">
				<span><h2 style="color:white;">欢迎,<?php echo $_SESSION["username"]; ?>管理员!</h2></span>
			</div>
			<form class="navbar-form navbar-right" role="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  				<button type="submit" class="btn btn-default btn-success" value="登出" name="logOut" style="margin-top: 8px;">退出</button>
			</form>
		</div>
	</nav> 
	<!-- 主体 -->
	<h1>请问您要？</h1>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="submit" name="selectS" value="查看学生状况" class="btn btn-info c">
		<input type="submit" name="selectT" value="查看正在等待确认的导师" class="btn btn-info c">
		<input type="submit" name="change" value="更改密码" class="btn btn-info c">
	</form>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>