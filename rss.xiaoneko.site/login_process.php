<?php
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}

if (!isset($_POST['posttype']))
{die("someting wrong");}

session_start();
$post_type = $_POST['posttype'];	
$student_num = $_POST['student_num'];
$password = $_POST['password'];
$result=mysqli_query($conn,"select * from users where  (student_num='$student_num') AND (password='$password')");
mysqli_close($conn);

if ($row=mysqli_fetch_array($result))
{
    $_SESSION['student_num']=$row['student_num'];
    $_SESSION['name']=$row['name'];
    $_SESSION['class']=$row['class'];
    $_SESSION['right']=$row['right'];
    $_SESSION['school']=$row['school'];
    $_SESSION['title']=$row['title'];
    $_SESSION['loginstate']=1;
    $name=$_SESSION['name'];
    echo '<script language="JavaScript">;alert("';
	echo"欢迎,$name,今天过得怎么样?";
	echo'");location.href="index.php";</script>;';
}
else{
    echo'<script>alert('; echo"'输入用户名密码错误');window.location.href="; echo'"login.php";</script>';
}
?>