<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>学生端</title>
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
		top: 200px;
		left: 550px;
		width: 300px;
		height: 80px;
	}
</style>
</head>
<?php
	//开始会话
	session_start();

	//连接数据库
	$conn=mysqli_connect("localhost","root","","departmentinfo");
	mysqli_query($conn,"set names utf8");

	if(isset($_POST['select'])){
		//按下选择导师的按钮
		if($_SESSION['state']!="选定"){
			//如果学生状态还不是选定，进入选择导师的页面
			header("location:selectTutor.php");
		}else{
			//若学生已经选择完导师，提示并倒回
			echo "<script language=\"JavaScript\">\r\n";
			echo "alert(\"您已经选择完导师\");\r\n";
			echo "history.back();\r\n";
			echo "</script>";
		}
	}

	if(isset($_POST['logOut'])){
		//登出按钮
		$_SESSION=array();
		session_destroy();
		header("location:../index.html");
	}

	if(isset($_POST['change'])){
		//进入个人信息的页面
		header("location:selfinfo.php");
	}
?>
<!-- 学生端网页布局 -->
<body style="padding-top: 0px;">
	<!-- 导航栏 -->
	<nav class="navbar navbar-default navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<span><h2 style="color:white;">欢迎,<?php echo $_SESSION["username"]; ?>同学!</h2></span>
			</div>
			<form class="navbar-form navbar-right" role="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  				<button type="submit" class="btn btn-default btn-success" value="登出" name="logOut" style="margin-top: 8px;">退出</button>
			</form>
		</div>
	</nav>
	<!-- 主体 -->
	<h1>请问您要？</h1>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<!-- 个人信息按钮 -->
		<input type="submit" name="change" value="查看个人信息或更改密码" class="btn btn-info c">
		<!-- 选择导师按钮 -->
		<input type="submit" name="select" value="选择导师" class="btn btn-info c">
	</form>
	<script src="../js/jquery-3.0.0.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>