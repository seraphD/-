<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>选定的学生</title>
	<style type="text/css">
	.table{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		margin-top: 50px;
	}
	[name=confirm],[name=reject]{
		position: relative;
		left: 560px;
		top: 40px;
		width: 200px;
	}
	.all{
		margin-left: 1300px;
	}
	p{
		display: inline-block;

	}
</style>
</head>
<body>
	<div class="page-header">
  		<h2 class="text-center">选定的学生</h2>
	</div>
	<span>
	</span>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<table class="table table-bordered table-hover">
	<tr><td>id</td><td>姓名</td><td>性别</td><td>专业</td><td>班级</td><td>电话</tr>
	<?php
	session_start();
	//查询state字段是选定的记录
	$conn=mysqli_connect("localhost","root","","departmentinfo");
	mysqli_query($conn,"set names utf8");
	$query="select * from students where state='选定' and tutorId=".$_SESSION['userID'].";";
	//显示学生信息
	$result=$conn->query($query);
	while($row=mysqli_fetch_array($result)){
		echo "<tr>"."<td>".$row['id']."</td>"."<td>".$row['name']."</td>"."<td>".$row['sex']."</td>"."<td>".$row['major']."</td>"."<td>".$row['classId']."</td>"."<td>".$row['phone']."</tr>";
	}
	?>
</table>
</form>
</body>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
</html>