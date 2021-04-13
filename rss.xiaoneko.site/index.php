<?php
session_start();
if($_SESSION['loginstate']!=1)
	{echo'<script>'; echo"window.location.href="; echo'"login.php";</script>';}
include_once('function.php');
page_head();
index_header();
index_center();
print_footer();

?>
