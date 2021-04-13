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
$student_num=$_SESSION['student_num'];
$name=$_SESSION['name'];
$class=$_SESSION['class'];
$right=$_SESSION['right'];
$school=$_SESSION['school'];
$title=$_SESSION['title'];




if($post_type=="change_position")
{

if (!isset($_POST['change_student_num']))
{
    $change_student_num=$student_num;
}else
{
    if($right==1 && $title!="班长")
    {
        if($student_num!=$_POST['change_student_num'])
        {
            die("您没有相应的操作权限:error_type=1");
        }
    }
    $change_student_num=$_POST['change_student_num'];  
}

$new_provience=$_POST['select1'];
$new_city=$_POST['select2'];
$new_zone=$_POST['select3'];
$new_atschool=$_POST['select4'];
$add=$_POST['add'];
$new_border=$_POST['border'];
$year=$_POST['select5'];
$month=$_POST['select6'];
$day=$_POST['select7'];
$now_year=date("Y");
$now_month=date("m");
$now_day=date("j");
$result=mysqli_query($conn,"select * from position where  student_num='$change_student_num' ");
if ($row=mysqli_fetch_array($result))
{
$provience=$row['provience'];
$city=$row['city'];
$zone=$row['zone'];
$border=$row['border'];
$atschool=$row['atschool'];
$his_school=$row['school'];
$his_class=$row['class'];
}
else
{
    die("没有在库内查到 $student_num 的信息");
}
if($border=="")
{
    $border="不在境外";
}
if($new_border=="")
{
    $new_border="不在境外";
}
$error_type=0;

if($right==2)
{
    if($school!=$his_school)
    {
        die("您没有相应的权限error_type=2");
    }
}
if($title=="班长")
{
    if($class!=$his_class)
    {
        die("您没有相应的权限error_type=3");
    }    
}
$school=$his_school;
$class=$his_class;

if((int)$now_year>=$year)
{
    

if(((int)$now_month*100+(int)$now_day)>=((int)$month*100+(int)$day))
{
$result2=mysqli_query($conn,"update position set provience='$new_provience',city='$new_city',zone='$new_zone',atschool='$new_atschool',border='$new_border' where student_num='$change_student_num' ");
$result_info = mysqli_affected_rows($conn);

$result4=mysqli_query($conn,"select * from position where student_num='$change_student_num' ");
if($row=mysqli_fetch_array($result4))
{
    $change_name=$row['name'];
}else
{
    die("数据库中查无此人，请联系管理员");
}



$result3=mysqli_query($conn,"INSERT INTO log (student_num,name,school,class,from_prov,from_city,from_zone,from_border,to_prov,to_city,to_zone,to_border,text,time,operator,state,year,month,day,from_atschool,to_atschool) 
				VALUES ('$change_student_num','$change_name','$school','$class','$provience','$city','$zone','$border','$new_provience','$new_city','$new_zone','$new_border','$add',now(),'$student_num','1','$year','$month','$day','$atschool','$new_atschool')");
$result_info2 = mysqli_affected_rows($conn);


if($result_info2==1 && $result_info==1)
{
    $error_type=0;
    
}
else{
    $error_type=1;
}


}else


{
    
$result4=mysqli_query($conn,"select * from position where student_num='$change_student_num' ");
if($row=mysqli_fetch_array($result4))
{
    $change_name=$row['name'];
}else
{
    die("数据库中查无此人，请联系管理员");
}

$result6=mysqli_query($conn,"select * from log where (student_num='$change_student_num')AND(state='0') order by num desc");
if($row=mysqli_fetch_array($result6))
{
$provience=$row['to_prov'];
$city=$row['to_city'];
$zone=$row['to_zone'];
$border=$row['to_border'];
$atschool=$row['to_atschool'];
}


$result3=mysqli_query($conn,"INSERT INTO log (student_num,name,school,class,from_prov,from_city,from_zone,from_border,to_prov,to_city,to_zone,to_border,text,time,operator,state,year,month,day,from_atschool,to_atschool) 
				VALUES ('$change_student_num','$change_name','$school','$class','$provience','$city','$zone','$border','$new_provience','$new_city','$new_zone','$new_border','$add',now(),'$student_num','0','$year','$month','$day','$atschool','$new_atschool')");
$result_info2 = mysqli_affected_rows($conn);
if($result_info2==1)
{
    $error_type=0;
    
}
else{
    $error_type=2;
}
}




}

if($error_type==0)
{
echo'<script>alert('; echo"'成功修改地理位置');window.location.href="; echo'"position.php?direct=class_change';echo'";</script>';
}
else
{
echo'<script>alert(';
echo"'修改操作失败,状态码为errortype:$error_type，请联系管理员');window.location.href=";
echo'"position.php?direct=class_change';echo'";</script>';
}


}

if($post_type=="change_password")
{
$result=mysqli_query($conn,"select * from users where  student_num='$student_num' ");
if ($row=mysqli_fetch_array($result))
{
$password=$row['password'];
$orgin_password=$_POST['origin_password'];
$new_password=$_POST['new_password'];
if($password!=$orgin_password)
{
    die("你的旧密码并非是 $orgin_password");    
}

$result2=mysqli_query($conn,"update users set password='$new_password' where student_num='$student_num' ");
$result_info = mysqli_affected_rows($conn);
if($result_info==1)
{
echo'<script>alert('; 
echo"'修改成功');window.location.href="; 
echo'"login.php";</script>';
$_SESSION['loginstate']=0;
}else
{
echo'<script>alert('; 
echo"'修改出现问题，请联系管理员解决');window.location.href="; 
echo'"user_security.php";</script>';    
}



}
else
{
    die("没有在库内查到 $student_num 的信息");
}
}

?>