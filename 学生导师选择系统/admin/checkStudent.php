<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>查看学生</title>
	<style type="text/css">
	.table{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		margin-top: 50px;
	}
	.state{
		position: relative;
		left: 80px;
	}
</style>
</head>
<body>
	<div class="page-header">
  		<h2 class="text-center">学生选择情况</h1>
	</div>
	<!-- 学生信息表格 -->
<table class="table table-bordered table-hover">
	<tr><td>id</td><td>姓名</td><td>性别</td><td>专业</td><td>班级</td><td>电话</td><td>状态<select class="state"><option value="all">全部</option><option value="n">未选</option><option value="w">待定</option><option value="c">选定</option></select></td><td>导师</td></tr>
<?php
$conn=mysqli_connect("localhost","root","","departmentinfo");
mysqli_query($conn,"set names utf8");
$query="select * from students;";
//查询数据
$result=$conn->query($query);
while($row=mysqli_fetch_array($result)){
	//根据学生的状态给表格的每一行加一个类
	$class='f ';
	if($row['state']=='未选'){
		$class=$class.'n';
	}else if($row['state']='待定'){
		$class=$class.'w';
	}else{
		$class=$class.'c';
	}
	//输出表格的一行，在状态列加一个下拉框
	echo "<tr class='$class'>"."<td>".$row['id']."</td>"."<td>".$row['name']."</td>"."<td>".$row['sex']."</td>"."<td>".$row['major']."</td>"."<td>".$row['classId']."</td>"."<td>".$row['phone']."</td>"."<td>".$row['state']."</td>"."<td>".$row['tutorId']."</td>"."</tr>";
}
?>
</table>
</body>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
	//下拉框反应，先隐藏再显示
	$('.state').change(function(){
		$('.f').hide();
		$s=$(this).val();
		if($s!='all')$('.'+$s).show();
		else{
			$('.f').show();
		}
	})
</script>
</html>