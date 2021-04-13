<?php
function page_head()//常规网页<head>部分
{
echo'
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/rsslogin.css" />
		<title>微统计</title>
	    <link rel="icon" href="../img/cat.png" type="image/x-icon" />
		<link rel="shortcut icon" href="../img/cat.png" type="image/x-icon" />
	<body>
';
}

function index_header()//常规网页头
{
echo'<script src="../js/jquery-3.4.1.min.js"></script>';
echo'<link rel="stylesheet" href="../css/header.css" type="text/css">';
echo'<div class="header">
    <div class="header_left">
        <img class="index_img" src="../img/index_img.png" onclick="window.location.href=';
echo"'http://rss.xiaoneko.site'";
echo'">
    </div>
    <div class="header_center">
        
    </div>
    <div class="header_right">
        <img id="loutout_img" src="../img/logout.png" onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/logout.php'";
echo'">
    </div>
</div>';

echo'<script type="text/javascript">';
echo"
$('#loutout_img').hover(
    function mouseover() {\$('#loutout_img').attr('src', '../img/logout2.png');}, 
    function mouseout()  {\$('#loutout_img').attr('src', '../img/logout.png');}
);
";
echo'</script>';



}

function print_footer()//常规网页脚
{
echo'<link rel="stylesheet" href="../css/footer.css" type="text/css">';
echo'
<div class="footer">
    <table class="footer_table">
        <tr class="footer_tr">
            <td class="footer_td"><a href="http://beian.bizcn.com/login.jsp">京ICP备19050178号</a></td>
            <td class="footer_td"><a href="help.html">联系我们</a></td>
            <td class="footer_td"><a href="help_doc.html">帮助文档</a></td>
            <td class="footer_td"><a href="shootboat.html">轻松一下</a></td>
            <td class="footer_td"><a href="http://stat.ruc.edu.cn">统计欢迎你</a></td>
        </tr>
    </table>
</div> 
</html>
';
}

function user_info()//常规个人信息部分(左上角)
{
session_start();
$student_num=$_SESSION['student_num'];
$name=$_SESSION['name'];
$class=$_SESSION['class'];
$school=$_SESSION['school'];
echo'<link rel="stylesheet" href="../css/user_info.css" type="text/css">';
echo'
<div class="user_info">
    <div class="head_potrait">
        <img class="head_img" src="../img/nobeko.PNG">
    </div>
    <div class="infos">
        <table>';
        

echo'<tr><td class="user_info_td">';
echo"$name";
echo'</td></tr>';
echo'<tr><td class="user_info_td">';
echo"$student_num";
echo'</td></tr>';
echo'<tr><td class="user_info_td">';
echo"$school";
echo'</td></tr>';
echo'<tr><td class="user_info_td">';
echo"$class";
echo'</td></tr>';

echo'
        </table>
    </div>
</div>
';        
}

function print_header_login()//登录界面的更宽的头
{
echo'<link rel="stylesheet" href="../css/login_header.css" type="text/css">';
echo'
<div class="header">
    <div class="header_container">
        <div class="header_left">
            <img class="logo" src="../img/header.png" onclick="window.location.href=';
echo"'http://rss.xiaoneko.site'";
echo'">
        </div>
        <div class="header_right">
            
        </div>
    </div>
</div>
';
}

function login_page_head()//登陆界面的<head>部分
{
echo'
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/rsslogin.css" />
		<title>微统计_登陆页面</title>
		<script language="javascript">
		  function chkinput(form)
		  {
		    if(form.student_num.value=="")
		    	{
		    	 alert("请输入学号!");
		    	 form.student_num.select();
		    	 return(false);
		    	}
		    	 if(form.password.value=="")
		    	{
		    	 alert("请输入密码");
		    	 form.password.select();
		    	 return(false);
		    	} 
		   return(true);
		  }
		</script>
	    <link rel="icon" href="../img/cat.png" type="image/x-icon" />
		<link rel="shortcut icon" href="../img/cat.png" type="image/x-icon" />
	<body>
';
}

function print_login()//登陆界面的中间部分
{
echo'
<div class="login_form">
    <div class="form_title">
        <img class="banner" src="../img/login_banner.png">
    </div>
    <div class="form_itself">
        <form class="inside_form" action="login_process.php" method="post" onSubmit="return chkinput(this)">
            <div class="input_div">
                <span class="input_span">学号:</span>
                <input class="my_input" type="text" name="student_num" placeholder="请输入学号"><br>
                <div class="block1"></div>
                <span class="input_span">密码:</span>
                <input class="my_input" type="password" name="password" placeholder="请输入密码">
                <input type="hidden" name="posttype" value="login">
            </div>
             <div class="button_div">    
                <button class="login_button" type="submit">登录</button>
            </div>
        </form>
    </div>
</div>
';    
}

function index_center()//主页的中心部分
{
echo'<link rel="stylesheet" href="../css/index_center.css" type="text/css">';
echo'
<div class="index_center">
    <div class="center_warpper">
    <div class="center_left">';
user_info();
echo'</div>';
index_center_right();
echo'</div></div>';
echo"</body>";
}

function index_center_right()
{
echo'
<div class="center_right">
    <div class="menu">
        <table>
            <tr>
                <td>
                    <p>应用功能</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="container">';
echo'<div class="img_div" onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=class_change'";
echo'"><img class="img" src="../img/position.png"></div>';

echo'<div class="img_div" onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/user_security.php'";
echo'"><img class="img" src="../img/key.png"></div>';


echo'
    </div>
</div>
';
}

function position_center($direct)//地理位置界面的中心部分
{
echo'<link rel="stylesheet" href="../css/position_center.css" type="text/css">';
echo'
<div class="position_center">
    <div class="center_warpper">
    <div class="center_left">';
user_info();
select_func();
echo'</div>';
position_center_right($direct);
echo'</div></div>';
}

function select_func()//地理位置界面左侧的选择栏
{
echo'<script src="../js/R.js"></script>';
echo'<link rel="stylesheet" href="../css/select_func.css" type="text/css">';
echo'<div class="select_func"><table>';
session_start();
$personal_open=0;
$right=$_SESSION['right'];
$title=$_SESSION['title'];
if($right==1&&$title=="学生")
{
    $personal_open=1;
}


if($personal_open==1)
{
echo'
<tr>
<td class="td_left" id="url_td_1"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=me'";
echo'">';
echo'
<p>我的位置</p>
</td>
<td class="td_right">
<div id="url1">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';



echo'
<tr>
<td class="td_left" id="url_td_2"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=mylog'";
echo'">';
echo'
<p>我的变动记录表</p>
</td>
<td class="td_right">
<div id="url2">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';
}

echo'
<tr>
<td class="td_left" id="url_td_3"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=class_change'";
echo'">';
echo'
<p>班内成员位置变动</p>
</td>
<td class="td_right">
<div id="url3">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';

echo'
<tr>
<td class="td_left" id="url_td_4"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=class_position'";
echo'">';
echo'
<p>班内成员位置表</p>
</td>
<td class="td_right">
<div id="url4">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';
 
echo'
<tr>
<td class="td_left" id="url_td_5"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=class_log'";
echo'">';
echo'
<p>班内变动记录表</p>
</td>
<td class="td_right">
<div id="url5">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';

echo'
<tr>
<td class="td_left" id="url_td_8"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=today_log'";
echo'">';
echo'
<p>本日变动记录表</p>
</td>
<td class="td_right">
<div id="url8">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';

echo'
<tr>
<td class="td_left" id="url_td_6"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=stat'";
echo'">';
echo'
<p>实时数据统计</p>
</td>
<td class="td_right">
<div id="url6">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';


echo'
<tr>
<td class="td_left" id="url_td_7"';
echo'onclick="window.location.href=';
echo"'http://rss.xiaoneko.site/position.php?direct=stat_by_time'";
echo'">';
echo'
<p>按日期查询数据</p>
</td>
<td class="td_right">
<div id="url7">
<img v-if="seen" src="../img/arrow.png">
</div>
</td></tr>
';


   
echo'</table></div>';
echo'<script src="../js/vue.min.js"></script>';
echo'<script src="../js/jquery-3.4.1.min.js"></script>';
echo'<script src="../js/R.js"></script>';
echo'<script type="text/javascript">';
echo"
var url1 =new Vue({
    el:'#url1',
    data:{
        seen:false
    }
})
var url2 =new Vue({
    el:'#url2',
    data:{
        seen:false
    }
})
var url3 =new Vue({
    el:'#url3',
    data:{
        seen:false
    }
})
var url4 =new Vue({
    el:'#url4',
    data:{
        seen:false
    }
})
var url5 =new Vue({
    el:'#url5',
    data:{
        seen:false
    }
})
var url6 =new Vue({
    el:'#url6',
    data:{
        seen:false
    }
})
var url7 =new Vue({
    el:'#url7',
    data:{
        seen:false
    }
})
var url8 =new Vue({
    el:'#url8',
    data:{
        seen:false
    }
})

var state = getQueryVariable('direct');
if(state==false)
{
state='me';
url1.seen=true;
}
if(state=='me')
{
    url1.seen=true;
}else
if(state=='mylog')
{
    url2.seen=true;
}else
if(state=='class_change')
{
    url3.seen=true;
}else
if(state=='class_position')
{
    url4.seen=true;
}
if(state=='class_log')
{
    url5.seen=true;
}
if(state=='stat')
{
    url6.seen=true;
}
if(state=='stat_by_time')
{
    url7.seen=true;
}
if(state=='today_log')
{
    url8.seen=true;
}

$('#url_td_1').hover(
    function mouseover() {\$('#url_td_1').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_1').find('p').css('color','#FAF0E6');}
);
$('#url_td_2').hover(
    function mouseover() {\$('#url_td_2').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_2').find('p').css('color','#FAF0E6');}
);
$('#url_td_3').hover(
    function mouseover() {\$('#url_td_3').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_3').find('p').css('color','#FAF0E6');}
);
$('#url_td_4').hover(
    function mouseover() {\$('#url_td_4').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_4').find('p').css('color','#FAF0E6');}
);
$('#url_td_5').hover(
    function mouseover() {\$('#url_td_5').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_5').find('p').css('color','#FAF0E6');}
);
$('#url_td_6').hover(
    function mouseover() {\$('#url_td_6').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_6').find('p').css('color','#FAF0E6');}
);
$('#url_td_7').hover(
    function mouseover() {\$('#url_td_7').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_7').find('p').css('color','#FAF0E6');}
);
$('#url_td_8').hover(
    function mouseover() {\$('#url_td_8').find('p').css('color','#FFD700');}, 
    function mouseout()  {\$('#url_td_8').find('p').css('color','#FAF0E6');}
);
</script>
";
}
?>