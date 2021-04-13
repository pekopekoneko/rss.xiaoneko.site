<?php
session_start();
include_once('function.php');
login_page_head();
print_header_login();

echo'<link rel="stylesheet" href="../css/login_center.css" type="text/css">';
echo'
<div class="center">
    <div class="center_inside">
        <div class="center_left">
            <img class="login_pic" src="../img/login_pic.png">
        </div>
        <div class="center_right">';
        
print_login();

echo'
        </div>
    </div>
</div>
';


print_footer();
echo'</body>';
echo'<script src="../js/jquery-3.4.1.min.js"></script>';
echo'<script src="../js/login.js"></script>';
echo'<script src="../js/vue.min.js"></script>';
?>

