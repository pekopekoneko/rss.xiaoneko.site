<?php
if(!$_POST['delete_num'])
{
    die("No post value");
}


$delete_num=$_POST['delete_num'];

$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
session_start();
$student_num=$_SESSION['student_num'];
$name=$_SESSION['name'];
$class=$_SESSION['class'];
$right=$_SESSION['right'];
$school=$_SESSION['school'];
$title=$_SESSION['title'];

$result=mysqli_query($conn,"select * from log where  num='$delete_num' ");
if ($row=mysqli_fetch_array($result))
{
$this_state=$row['state'];
$this_school=$row['school'];
$this_class=$row['class'];
}
if($right==2)
{
    if($school!=$this_school)
    {
        die("您没有相应的权限error_type=2");
    }
}
if($title=="班长")
{
    if($class!=$this_class)
    {
        die("您没有相应的权限error_type=3");
    }    
}

$this_year=$row['year'];
$this_month=$row['month'];
$this_day=$row['day'];
$now_year=date("Y");
$now_month=date("m");
$now_day=date("j");
$this_error=0;
if($now_year<$this_year){$this_error=1;}else
if($now_month<$this_month){$this_error=1;}else
if($now_day<=$this_day){$this_error=1;}
if($this_error!=1)
{
    die('您不可以删除昨日及以前的位置变动');
}



if($row['state']==0)
{
    $result=mysqli_query($conn,"DELETE FROM log WHERE num = '$delete_num' ");
    $result_info = mysqli_affected_rows($conn);
    if($result_info==1)
    {
        echo'<script>alert('; echo"'成功删除位置变更');window.location.href="; echo'"position.php?direct=class_log';echo'";</script>';
    }else
    {
        echo'<script>alert('; echo"'修改位置失败，请联系管理员');window.location.href="; echo'"position.php?direct=class_log';echo'";</script>';
    }
}

if($row['state']==1)
{
    $from_prov=$row['from_prov'];
    $from_city=$row['from_city'];
    $from_zone=$row['from_zone'];
    $from_border=$row['from_border'];
    $from_atschool=$row['from_atschool'];
    $this_student_num=$row['student_num'];
    $result1=mysqli_query($conn,"update position set provience='$from_prov',city='$from_city',zone='$from_zone',atschool='$from_atschool',border='$from_border' where student_num='$this_student_num' ");
    $result_info1 = mysqli_affected_rows($conn);
    $result2=mysqli_query($conn,"DELETE FROM log WHERE num = '$delete_num' ");
    $result_info2 = mysqli_affected_rows($conn);
    if($result_info1==1&&$result_info2==1)
    {
        echo'<script>alert('; echo"'成功删除位置变更');window.location.href="; echo'"position.php?direct=class_log';echo'";</script>';
    }else
    {
        echo'<script>alert('; echo"'修改位置失败，请联系管理员');window.location.href="; echo'"position.php?direct=class_log';echo'";</script>';
    }
}


?>