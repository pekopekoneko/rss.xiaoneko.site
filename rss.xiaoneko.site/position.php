<?php
session_start();
if($_SESSION['loginstate']!=1)
	{echo'<script>alert('; echo"'你还没有登陆哦');window.location.href="; echo'"login.php";</script>';}
include_once('function.php');
if($_GET['direct']!=NULL)
{
$direct=$_GET['direct'];
}
else
{
$direct="me";   
}
page_head();
index_header();
position_center($direct);
print_footer();

?>
