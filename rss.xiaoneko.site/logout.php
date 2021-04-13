<?php
session_start();
$_SESSION['loginstate']=0;
session_destroy();
echo'<script>alert(';
echo"'注销成功');window.location.href="; 
echo'"login.php";</script>';
?>
