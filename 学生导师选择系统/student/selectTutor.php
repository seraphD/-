<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>导师选择</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	.table{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
	}
	#submit{
		position: absolute;
		left: 40%;
	}
	.selectP,.selectD{
		position: relative;
		left: 50%;
	}
</style>
</head>
<body>
	<div class="page-header">
  		<h2 class="text-center">导师选择</h1>
	</div>
<?php
	//会话开始，连接数据库
	session_start();
	$conn=mysqli_connect("localhost","root","","departmentinfo");
	mysqli_query($conn,"set names utf8");

	if(isset($_POST['confirm'])){
		//选择导师，获取导师id和学生id
		$id=$_POST['id'];
		$stuId=$_SESSION['userID'];
		if($id){
			//更新数据库信息
			$name=$_SESSION['username'];
			$query="update students set state=\"待定\",tutorId=\"$id\" where name="."\"".$name."\";";
			if($conn->query($query)){
				$_SESSION['state']="待定";
				$_SESSION['tutorId']=$id;
				header("location:student.php");
			}else{
				//选择失败
				echo "<script language=\"JavaScript\">\r\n";
				echo "alert(\"选择失败！\");\r\n";
				echo "history.back();\r\n";
				echo "</script>";
			}
		}else{
			//没有填好id就按下了确定
			echo "<script language=\"JavaScript\">\r\n";
			echo "alert(\"快选！！\");\r\n";
			echo "history.back();\r\n";
			echo "</script>";
		}
	}
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-inline">
	<div class='form-group' id="submit">
		<label for="tutorId">导师ID</label>
		<input type="text" name="id" class='form-control' id="tutorId">
		<input type="submit" name="confirm" value="提交" class="btn btn-success" data-toggle="modal" data-target="#myModal">
	</div>
</form><br><br><br>
<!-- 导师信息表格 -->
<table class="table table-bordered table-hover">
	<!-- 每一位导师的信息，加上下拉框 -->
	<tr><td>导师ID</td><td>导师姓名</td><td>性别</td><td>职位<select class="selectP"><option selected="" value="all">全部</option><option value="p">教授</option><option value="ap">副教授</option><option value="c">院长</option><option value="ac">副院长</option><option></option></select></td><td>研究方向<select class="selectD"><option selected="" value="all">全部</option><option value="e">软件工程</option><option value="i">物联网</option><option value="comp">计算机</option><option value="edu">小学教育</option><option value="sp">体育</option></select></td><td>电话</td></tr>
<?php
	//查询导师
	$query="select * from teacher";
	$result=$conn->query($query);

	while ($row=mysqli_fetch_array($result)) {
		//根据导师的职位和研究方向添加每一行的类，方便筛选
		$class='f ';
		if($row['position']=='教授'){
			$class=$class."p";
		}else if($row['position']=='副教授'){
			$class=$class."ap";
		}else if($row['position']=='院长'){
			$class=$class."c";
		}else if($row['position']=='副院长'){
			$class=$class."ac";
		}

		$class=$class." ";

		if($row['direction']=='软件工程'){
			$class=$class."e";
		}else if($row['direction']=='物联网'){
			$class=$class."i";
		}else if($row['direction']=='计算机'){
			$class=$class."comp";
		}else if($row['direction']=='小学教育'){
			$class=$class."edu";
		}else $class=$class."sp";
		//输出一行
		echo "<tr class='$class'>"."<td>".$row['id']."</td>"."<td>".$row['name']."</td>"."<td>".$row['sex']."</td>"."<td>".$row['position']."</td>"."<td>".$row['direction']."</td>"."<td>".$row['phone']."</td>"."</tr>";
	}
?>
</table>
<script src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
//根据一行的类进行筛选，先将整张表格隐藏，然后将需要的部分显示
function search($op1,$op2) {
	$(".f").hide();
	if($op1=='all'&&$op2=='all'){
		$(".f").show();
	}else{
		if($op1=='all'&&$op2!='all'){
			$('.'+$op2).show();
		}else if($op1!='all'&&$op2=='all'){
			$('.'+$op1).show();
		}else{
			$('.'+$op1+'.'+$op2).show();
		}
	}
}
//下拉框响应函数，将另一个下拉框的内容作为另一个参数
$(".selectP").change(function(){
	$p1=$(this).val();
	$p2=$(".selectD").val();
	search($p1,$p2);
})

$('.selectD').change(function(){
	$p1=$('.selectP').val();
	$p2=$(this).val();
	search($p1,$p2);
})

</script>
</body>
</html>