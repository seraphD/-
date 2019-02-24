<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<title>更改密码</title>
	<meta charset="utf-8">
	<style type="text/css">
	body{
		background-color: lightgray;
	}
	h1{
		position: relative;
		left: 45%;
	}
	p{
		display: inline-block;
		font-size: 20px;
	}
	span{
		display: inline-block;
		position: relative;
		top: 70px;
		left: 40%;
		margin-bottom: 50px;
	}
	.sp{
		left: 595px;
	}
	[type=submit]{
		position: relative;
		left: 700px;
		top: 100px;
	}
</style>
</head>
<body>
	<?php
		session_start();
		if(isset($_POST['submit'])){
			//连接数据库
			$conn=mysqli_connect("localhost","root","","departmentinfo");
			$user=$_SESSION['user'];
			$username=$_SESSION['userID'];
			//从会话中获取使用者类型和用户名
			$oldPassword=$_POST['oldPassword'];
			$newP=$_POST['newpassword'];
			$confirm=$_POST['confirmpassword'];	
			//获取表单提交的密码和新密码和确认密码

			$query="select * from ".$user." where id="."\"".$username."\"".";";
			$result=mysqli_fetch_array($conn->query($query))['password'];
			//根据使用者的类别查询不同的表获取数据库中存储的老密码

			if($oldPassword==$result){
				//旧密码输入正确
				if($newP==$confirm){
					//确认密码输入正确
					$query="update ".$user." set password="."\"".$newP."\""."where id="."\"".$username."\"";
					if($conn->query($query)){
						if($_SESSION['user']=="students"){
							header("location:student.php");
						}else if($_SESSION['user']=="teacher"){
							header("location:teacher.php");
						}else{
							header("location:admin.php");
						}
					}
					//更新数据库跳转回相应得页面
				}else{
					echo "<script language=\"JavaScript\">\r\n";
					echo "alert(\"密码不一致\");\r\n";
					echo "history.back();\r\n";
					echo "</script>";
					exit;
				}
			}else{
			}
		}
	?>
	<divc class="main">
		<h1>更改信息</h1>
		<!-- 更改密码索要的环节的表单 -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

			<span><p>用户名：</p><input type="text" name="user"></span><br>
			<span><p>旧密码：</p><input type="password" name="oldPassword"></span><br>
			<span><p>新密码：</p><input type="password" name="newpassword"></span><br>
			<span class="sp"><p>确认密码：</p><input type="password" name="confirmpassword"></span><br>
			<input type="submit" name="submit" class="btn btn-primary btn-lg">
		</form>
	</div>
	<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>