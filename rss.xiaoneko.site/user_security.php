<?php
session_start();
if($_SESSION['loginstate']!=1)
	{echo'<script>alert('; echo"'你还没有登陆哦');window.location.href="; echo'"login.php";</script>';}
include_once('function.php');
page_head();
index_header();
echo'<link rel="stylesheet" href="../css/index_center.css" type="text/css">';
echo'<script src="../js/jquery-3.4.1.min.js"></script>';
echo'
<div class="index_center">
    <div class="center_warpper">
    <div class="center_left">';
user_info();
echo'</div>';
echo'
<div class="center_right">
    <div class="menu">
        <table>
            <tr>
                <td>
                    <p>密码修改</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="form_div">';
    
echo'
<form class="inside_form" action="process.php" method="post" onSubmit="return checkinput(this)">
        <input type="hidden" name="posttype" value="change_password"> 
        <div class="add">
            <span>原密码:</span>
            <input type="text" name="origin_password" placeholder="请输入原密码"> 
        </div>
        <div class="add">
            <span>新密码:</span>
            <input type="password" id="new_password" name="new_password" placeholder="新密码"> 
        </div>
        <div class="add">
            <span>重复输入新密码:</span>
            <input type="password" id="new_password2" name="new_password1" placeholder="请重复输入新密码"> 
        </div>
        <div class="button_div">    
            <button class="submit_button" type="submit">修改</button>
        </div>
</form>
';

echo'</div></div></div></div>';


echo'<script type="text/javascript">';
echo"
function checkinput(form)
{
    if($('#new_password').val()!=$('#new_password2').val())
    {
        alert('两次输入的密码不相同!');
        return(false);
    }
    return(true);
}
";
echo'</script>';
echo"</body>";
print_footer();

?>
