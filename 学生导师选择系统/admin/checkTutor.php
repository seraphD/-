<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>查看导师</title>
	<style type="text/css">
	.table{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		margin-top: 50px;
	}
</style>
</head>
<body>
	<div class="page-header">
  		<h2 class="text-center">导师</h1>
	</div>
<table class="table table-bordered table-hover">
	<tr><td>导师id</td><td>导师姓名</td><td>学生姓名</td><td>状态</td></tr>
<?php
$conn=mysqli_connect("localhost","root","","departmentinfo");
mysqli_query($conn,"set names utf8");
$query="select t.id,t.name as tutorname,s.name,s.state from students as s,teacher as t where s.state='待定' and s.tutorid=t.id;";
//查询数据库，将待确认的导师和学生的信息输出
$result=$conn->query($query);
while($row=mysqli_fetch_array($result)){
	echo "<tr>"."<td>".$row['id']."</td>"."<td>".$row['tutorname']."</td>"."<td>".$row['name']."</td>"."<td>".$row['state']."</td>"."</tr>";
}
?>
</table>
</body>
</html>