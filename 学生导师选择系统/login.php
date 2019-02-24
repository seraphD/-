<?php
//连接数据库
$conn=mysqli_connect("localhost","root","","departmentinfo");
mysqli_query($conn,"set names utf8");

//获取表单数据，包括用户名和密码
$account=$_POST["account"];
$password=$_POST["password"];
$user=$_POST['user'];

//如果用户名为空，提示输入用户名
if($account==NULL){
	echo "<script language=\"JavaScript\">\r\n";
	echo "alert(\"请输入用户名和密码\");\r\n";
	echo "history.back();\r\n";
	echo "</script>";
	exit;
}
//开始会话
session_start();

//获取正确密码的sql语句
if($user=="students"){
	$querry="select * from students where id="."\"".$account."\"".";";
}else if($user=="teacher"){
	$querry="select * from teacher where id="."\"".$account."\"".";";
}else{
	$querry="select * from manager where id="."\"".$account."\"".";";
}
//执行
$result=$conn->query($querry);

if($result){
	//获取正确密码
	$row=mysqli_fetch_array($result);
	$correct=$row['password'];

	if($correct==$password){
		//如果密码正确，将共有的个人信息放入会话中，方便接下来的网页使用
		$_SESSION['username']=$row['name'];
		$_SESSION['user']=$user;
		$_SESSION['userID']=$account;
		if($user=="students"){
			//放入学生独有的信息
			$_SESSION['major']=$row['major'];
			$_SESSION['classId']=$row['classId'];
			$_SESSION['phone']=$row['phone'];
			$_SESSION['state']=$row['state'];
			$_SESSION['sex']=$row['sex'];

			if($row['state']!='未选'){
				$_SESSION['tutorId']=$row['tutorId'];
			}
			header("location:student/student.php");
		}else if($user=="teacher"){
			//放入教师独有的信息
			$_SESSION['position']=$row['position'];
			$_SESSION['direction']=$row['direction'];
			$_SESSION['phone']=$row['phone'];
			$_SESSION['sex']=$row['sex'];
			header("location:teacher/teacher.php");
		}else{
			//放入管理员独有的信息
			$_SESSION['username']=$row['name'];
			header('location:'."admin/admin.php");
		}

	}else{
		//密码不正确，倒回
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户名或密码不正确\");\r\n";
		echo "history.back();\r\n";
		echo "</script>";
		exit;
	}
}else{
	die("用户名或密码不正确");
}
?>