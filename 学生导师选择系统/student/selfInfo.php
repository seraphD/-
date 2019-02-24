<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>个人信息</title>
	<meta charset="utf-8">
	<style type="text/css">
	body{
		background-color: lightgray;
	}
	.infoBox{
		border-style: solid;
		border-width: 4px;
		border-color:black;
		width: 600px;
		height: 430px;
		position: absolute;
		left: 30%;
		top: 10%;
	}
	p{
		display: inline-block;
	}
	span{
		display:inline-block;
		margin-bottom: 50px;
		margin-left: 20px;
		font-size: 150%;
		/*width: 300px;*/
	}
	.second{
		position: absolute;
		left: 60%;
	}
	.btn{
		margin-left: 20px;
		width: 200px;
	}
</style>
</head>
<!-- 个人信息页面 -->
<body>
	<?php
	session_start();
	//更改密码
	if(isset($_POST['changePassword'])){
		header("location:../PasswordChange.php");
	}
	//返回上一个页面
	if(isset($_POST['return'])){
		header("location:student.php");
	}
	?>
<!-- 个人信息 -->
<div class="infoBox">
<span><p>姓名：</p><?php echo $_SESSION['username']; ?></span>
<span class="second"><p>ID：</p><?php echo $_SESSION['userID']; ?></span><br>
<span><p>性别：</p><?php echo $_SESSION['sex']; ?></span>
<span class="second"><p>专业：</p><?php echo $_SESSION['major']; ?></span><br>
<span><p>班级：</p><?php echo $_SESSION['classId']; ?></span>
<span class="second"><p>电话：</p><?php echo $_SESSION['phone']; ?></span><br>
<span><p>状态：</p><?php echo $_SESSION['state']; ?></span>
<?php
//如果学生的状态不是未选，则显示已经选定的导师或者等待确认的导师
if($_SESSION['state']!='未选'){
	$tutorId=$_SESSION['tutorId'];
	echo "<span class=\"second\"><p>导师ID:</p>".$tutorId."</span><br>";
}
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="changePassword" value="更改密码" class="btn btn-primary">
<input type="submit" name="return" value="返回" class="second btn btn-primary">
</form>
</div>
</body>
</html>