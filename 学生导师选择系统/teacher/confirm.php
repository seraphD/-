<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>选择学生</title>
	<style type="text/css">
	.table{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		margin-top: 50px;
	}
	[type=checkbox]{
		position: relative;
		left: 180px;
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
  		<h2 class="text-center">选定学生</h1>
	</div>
	<span>
	<input type="button" name="all" value="全选" class="btn btn-info all">
	<input type="button" name="none" value="全不选" class="btn btn-info none">
	</span>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<table class="table table-bordered table-hover">
	<tr><td>id</td><td>姓名</td><td>性别</td><td>专业</td><td>班级</td><td>电话</tr>
	<?php
	//连接数据库，开始会话
	session_start();

	$conn=mysqli_connect("localhost","root","","departmentinfo");
	mysqli_query($conn,"set names utf8");
	$query="select * from students where state='待定' and tutorId=".$_SESSION['userID'].";";
	//查询等待自己确认的学生，查询导师id和自己id相同的记录
	$result=$conn->query($query);
	while($row=mysqli_fetch_array($result)){
		echo "<tr>"."<td>".$row['id']."</td>"."<td>".$row['name']."</td>"."<td>".$row['sex']."</td>"."<td>".$row['major']."</td>"."<td>".$row['classId']."</td>"."<td>".$row['phone']."<input type=\"checkbox\" class='stu' name=\"select[]\" value=\"".$row['id']."\">"."</td>"."</tr>";
	}

	if(isset($_POST['confirm'])){
		//确认选中的学生
		if(!empty($_POST['select'])){
			//将被复选框选中的学生放入数组中
			$student=array();
			$student=$_POST['select'];
			//更新数组中学生的数据库信息，将状态更改为确认
			foreach ($student as $key => $value) {
				$query="update students set state='选定' where id='$value';";
				$conn->query($query);
			}
		}
		//更新完毕后返回
		header("location:teacher.php");
	}

	if(isset($_POST['reject'])){
		//拒绝选中的学生
		if(!empty($_POST['select'])){
			$student=array();
			$student=$_POST['select'];
			//更改数据库信息，将状态更改为未选
			foreach ($student as $key => $value) {
				$query="update students set state='未选',tutorId='' where id='$value';";
				$conn->query($query);
			}
		}
		//返回
		header("location:teacher.php");
	}
	?>
</table>
<input type="submit" name="confirm" value="接受" class="btn btn-info">
<input type="submit" name="reject" value="拒绝" class="btn btn-info">
</form>
</body>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
	//全选响应，将所有学生的复选框的checked属性设置为true
	$(".all").click(function(){
		$(".stu").each(function(){
			$(this).prop('checked',true);
		})
	})
	//全不选响应
	$(".none").click(function(){
		$(".stu").each(function(){
			$(this).prop('checked',false);
		})
	})
</script>
</html>