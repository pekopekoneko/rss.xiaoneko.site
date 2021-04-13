<?php
include_once('function_origin.php');




function position_center_right($direct)//地理位置界面右侧的栏目
{
session_start();
$student_num=$_SESSION['student_num'];
$class=$_SESSION['class'];
$right=$_SESSION['right'];
$title=$_SESSION['title'];
$school=$_SESSION['school'];
$now_year=date("Y");
$now_month=date("m");
$now_day=date("j");
echo'<script src="../js/vue.min.js"></script>';
echo'<script src="../js/R.js"></script>';
echo'<script src="../js/jquery-3.4.1.min.js"></script>';
echo'<script src="../js/xlsx.core.min.js"></script>';
echo'<script src="../js/xlsx.js"></script>';
echo'<div class="center_right">';
if($direct=="me")
{
echo'<link rel="stylesheet" href="../css/center_right.css" type="text/css">';
echo'
<div class="nowstate">
    <table class="now_state_table">
    <tr class="now_state_tr">
        <td class="now_state_td">您现在所在的位置:</td>';

$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
$year=date("Y");
$month=date("m");
$day=date("j");
session_start();
$student_num=$_SESSION['student_num'];
$result=mysqli_query($conn,"select * from position where  student_num='$student_num' ");
if ($row=mysqli_fetch_array($result))
{
    $_SESSION['provience']=$row['provience'];
    $_SESSION['city']=$row['city'];
    $_SESSION['zone']=$row['zone'];
    $provience=$row['provience'];
    $city=$row['city'];
    $zone=$row['zone'];
    $atschool=$row['atschool'];
    echo'<td class="now_state_td" id="now_provience">',$provience,'</td>';
    echo'<td class="now_state_td" id="now_city">',$city,'</td>';
    echo'<td class="now_state_td" id="now_zone">',$zone,'</td>';
}
else{
    echo'<script>alert('; echo"'没有你的位置信息，请联系管理员');window.location.href="; echo'"login.php";</script>';
}
echo'
    </tr>
    </table>
</div>
';

echo'<div class="change">';
echo'<script type="text/javascript">';
$result=mysqli_query($conn,"select * from proviences");
$row=mysqli_fetch_array($result);
$provience=$row['provience'];
$city=$row['city'];
$zone=$row['zone'];

echo'var proviences = [["',$provience,'","',$city,'","',$zone,'"]];';
while($row=mysqli_fetch_array($result))
{
$provience=$row['provience'];
$city=$row['city'];
$zone=$row['zone'];
echo'proviences.push(["',$provience,'","',$city,'","',$zone,'"]);';
}
echo'</script>';

echo'
<div id="form">
    <form class="position_change_form" action="process.php" method="post" onSubmit="return normal_check(this)">
        <input type="hidden" name="posttype" value="change_position">
        <div class="form_title">
            <p>请在下方填写你的地理位置变动信息</p>
        </div>
        <div id="select1">
            <span>省份:</span>
            <select name="select1" id="select_1">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select2">
            <span>城市:</span>
            <select name="select2" id="select_2">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select3">
            <span>区:</span>
            <select name="select3" id="select_3">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select4">
            <span>在校状态:</span>
            <select name="select4" id="select_4">
                <option>不在校</option>
                <option>在校</option>
            </select>
        </div>
        <div id="select5">
            <span>变动时间(年):</span>
            <select name="select5" id="select_5">
                <option>2021</option>
                <option>2020</option>
                <option>2022</option>
            </select>
        </div>
        <div id="select6">
            <span>月:</span>
            <select name="select6" id="select_6">';
            
for($temp=1;$temp<13;$temp++)
{
if($month==$temp)
{echo'<option value="';echo"$temp";echo'" selected="selected">';echo"$temp";echo'</option>';}
else
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
}


echo'
            </select>
        </div>
        <div id="select7">
            <span>日:</span>
            <select name="select7" id="select_7">
';


for($temp=1;$temp<32;$temp++)
{
if($day==$temp)
{echo'<option value="';echo"$temp";echo'" selected="selected">';echo"$temp";echo'</option>';}
else
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
}


echo'
            </select>
        </div>
        <div class="add">
            <span>备注:</span>
            <input type="text" name="add" value="无"> 
        </div>';
echo'
        <div id="form_border" v-if="seen">
            <span>具体位置:</span>
            <input type="text" name="border" placeholder="请输入具体到街区的地址">
        </div>
        <div class="button_div">    
            <button class="button" id="position_button" type="submit">提交</button>
        </div>
    </form>
</div>
';

echo'
<script type="text/javascript">
var a = my_unique(fetch_col(proviences,0));
var b = my_unique(fetch_col(proviences,1));
var c = my_unique(fetch_col(proviences,2));';
echo"var atschool = '$atschool'";
echo"
var select_1 = new Vue({
  el: '#select_1',
  data: {
    list: a
}
})
var select_2 = new Vue({
  el: '#select_2',
  data: {
    list: b
}
})
var select_3 = new Vue({
  el: '#select_3',
  data: {
    list: c
  }
})
var border = new Vue({
    el:'#form_border',
    data:{
        seen:false
    }
})

var temp=$('#select_1').val();
var temp2=$('#select_2').val();
var temp3=$('#select_1').val();
var new_proviences=proviences;
$('#select_1').change(function() {
temp=$('#select_1').val();
new_proviences=my_which(proviences,0,temp);
b = my_unique(fetch_col(new_proviences,1));
c = my_unique(fetch_col(new_proviences,2));
select_2.list=b;
select_3.list=c;
});
$('#select_2').change(function() {
temp2=$('#select_2').val();
new_proviences2=my_which(new_proviences,1,temp2);
c = my_unique(fetch_col(new_proviences2,2));
select_3.list=c;
});
$('#select_1').change(function(){
if($('#select_1').val()=='港澳台')
{
    border.seen=true;
}
if($('#select_1').val()=='国外')
{
    border.seen=true;
} 
})

function normal_check(form)
{
    if($('#select_1').val()!='北京市' && $('#select_4').val()=='在校')
    {
    alert('不在北京不可能在校，请检查输入');
    $('#select_1').css('background-color','#FFF0F5');
    $('#select_4').css('background-color','#FFF0F5');
    return(false);
    }
    if($('#border').val()=='在境内')
    {
    alert('请认真填写所在地');
    $('#border').css('background-color','#FFF0F5');
    return(false);
    }
    if($('#now_provience').text()==$('#select_1').val())
    {
        if($('#now_city').text()==$('#select_2').val())
        {
            if(atschool==$('#select_4').val())
            {
                alert('您的位置没有变更，请不要胡闹');
                return(false);
            }
        }
    }
    if($('#border').val()=='')
    {
        alert('这个不可以不填哦');
        $('#border').css('background-color','#FFF0F5');
        return(false);
    }
    return(true);
}
$('#position_button').hover(
    function mouseover() {\$('#position_button').css('color','#00FA9A');}, 
    function mouseout()  {\$('#position_button').css('color','white');}
);
</script>";



echo'</div>';

$result=mysqli_query($conn,"select count(*) from log where student_num='$student_num'");
$row=mysqli_fetch_array($result);
$result2=mysqli_query($conn,"select * from log where student_num='$student_num' order by num desc");
$row2=mysqli_fetch_array($result2);
$row=$row[0];
if($row==0)
{
echo'
<div class="center_right_bottom">
    <table class="center_right_bottom">
        <tr class="center_right_bottom_tr">
            <td colspan="6" class="wid_td">
                您没有过地理位置变动
            </td>
        </tr>
        <tr class="center_right_bottom_tr">
            <td class="center_right_bottom_td"></td>
        </tr>
        <tr class="center_right_bottom_tr">
            <td class="center_right_bottom_td"></td>
        </tr>
    </table>
</div>
';  
}
else
{
$name=$row2['name'];
$student_num=$row2['student_num'];
$year=$row2['year'];
$month=$row2['month'];
$day=$row2['day'];
$from_prov=$row2['from_prov'];
$from_city=$row2['from_city'];
$from_zone=$row2['from_zone'];
$from_border=$row2['from_border'];
$to_prov=$row2['to_prov'];
$to_city=$row2['to_city'];
$to_zone=$row2['to_zone'];
$to_border=$row2['to_border'];
$time=$row2['time'];
$operator=$row2['operator'];
if($operator==$student_num)
{
    $operator="由你自己迁移";
}
else
{
    $operator="由他人迁移";
}
echo'
<div class="center_right_bottom">
    <table class="center_right_bottom">
        <tr class="center_right_bottom_tr">
            <td colspan="7" class="wid_td">
                上次变更情况
            </td>
        </tr>
        <tr class="center_right_bottom_tr">
';

echo'<td class="center_right_bottom_td1">';
echo"$name $student_num";
echo'</td>';
echo'<td class="center_right_bottom_td1">';
echo"从";
echo'</td>';
echo'<td class="center_right_bottom_td2">';
echo"$from_prov";
echo'</td>';
echo'<td class="center_right_bottom_td3">';
echo"$from_city";
echo'</td>';
echo'<td class="center_right_bottom_td4">';
echo"$from_zone";
echo'</td>';
echo'<td class="center_right_bottom_td5">';
echo"$from_border";
echo'</td>';
echo'<td class="center_right_bottom_td6">';
echo"操作时间为:$time";
echo'</td>';
echo'</tr>';

echo'<tr class="center_right_bottom_tr">';
echo'<td class="center_right_bottom_td1">';
echo"$year 年 $month 月 $day 日";
echo'</td>';
echo'<td class="center_right_bottom_td1">';
echo"至";
echo'</td>';
echo'<td class="center_right_bottom_td2">';
echo"$to_prov";
echo'</td>';
echo'<td class="center_right_bottom_td3">';
echo"$to_city";
echo'</td>';
echo'<td class="center_right_bottom_td4">';
echo"$to_zone";
echo'</td>';
echo'<td class="center_right_bottom_td5">';
echo"$to_border";
echo'</td>';
echo'<td class="center_right_bottom_td6">';
echo"$operator";
echo'</td>';
echo'</tr>';



echo'
    </table>
</div>
';
}






}# if direct == me

if($direct=="mylog")
{
echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
$result=mysqli_query($conn,"select * from log where student_num='$student_num' order by num desc");
#19
echo'
<script type="text/javascript">
var state_type = 0 ;
';

if(mysqli_num_rows($result)==0)
{
echo'
state_type=1;
';
}
else
{
echo'var content = [';
$temp = 0;
while($row=mysqli_fetch_array($result))
{
    if($temp==0)
    {
        echo'[';
        $temp=1;
    }
    else
    {
        echo',[';
    }
    $student_num=$row['student_num'];
    $name=$row['name'];
    $class=$row['class'];
    $from_prov=$row['from_prov'];
    $from_city=$row['from_city'];
    $from_zone=$row['from_zone'];
    $from_border=$row['from_border'];
    $from_atschool=$row['from_atschool'];
    $to_prov=$row['to_prov'];
    $to_city=$row['to_city'];
    $to_zone=$row['to_zone'];
    $to_border=$row['to_border'];
    $to_atschool=$row['to_atschool'];
    $time=$row['time'];
    $operator=$row['operator'];
    echo"'$student_num' , '$name' , '$class' , '$from_prov' , '$from_city' , '$from_zone' , '$from_border' ,'$from_atschool', '$to_prov' , '$to_city' , '$to_zone' , '$to_border' ,'$to_atschool', '$time' , '$operator' , '$year' , '$month' , '$day'";
    echo']';
}
echo'];';
}



echo"
if(state_type==1)
{
    var content=[['无信息']];
}
";
echo'</script>';





echo'
<div class="center_right">
    <div class="table_head">
        <div class="table_head_left">
            
        </div>
        <div class="table_head_right">
            <p>个人变动情况</p>
        </div>
    </div>
    <div id="table_body">
        <table>
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>班级</th>
                <th>出发省</th>
                <th>出发市</th>
                <th>出发区</th>
                <th>境外所在</th>
                <th>在校(前)</th>
                <th>到达省</th>
                <th>到达市</th>
                <th>到达区</th>
                <th>到达境外</th>
                <th>在校(后)</th>
                <th>操作时间</th>
                <th>操作者</th>
                <th>变动年</th>
                <th>月</th>
                <th>日</th>
            </tr>
            <tr v-for="row in datas">
                <td v-for="col in row">{{ col }}</td>
            </tr>
        </table>
    </div>
    <div class="page_change">
        <div class="page_change_left">
            <span>
            <span>前往第</span><input type="text" id="input_page"><span>页</span>
            </span>
            <span>
            <span>一页显示</span><input type="text" id="row_one_page"><span>条</span>
            </span>
            <span>
            <span>搜索</span><input type="text" id="student_name" placeholder="姓名或学号"><span>同学信息</span>
            </span>
        </div>
        <div id="back">
        <table><tr><td>
            <p id="back_page" v-if="seen">上一页</p>
        </table></tr></td>
        </div>
        <div id="next">
        <table><tr><td>
            <p id="next_page" v-if="seen">下一页</p>
        </table></tr></td>
        </div>
    </div>
</div>
';
echo'<script type="text/javascript">';
echo"
var back_page = new Vue({
    el:'#back_page',
    data:{
        seen:true
    }
})
var next_page = new Vue({
    el:'#next_page',
    data:{
        seen:true
    }
})
var now_page=1;
var list_one_page = 3;
var now_content = to_page(content,now_page,list_one_page);
var table_body = new Vue({
    el:'#table_body',
    data:{
        datas:now_content
    }
})
var last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
next_page.seen=false; 
}


\$('#back').hover(
    function mouseover() {\$('#back_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#back_page').css('color','#FF6347');}
);
\$('#next').hover(
    function mouseover() {\$('#next_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#next_page').css('color','#FF6347');}
);
\$('#back').click(
function(){
if(now_page>=2)
{
now_page=now_page-1;   
}
if(now_page==1)
{
    
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;        
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
\$('#next').click(
function(){
if(now_page<last_page)
{
    now_page=now_page+1;
}
if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
";
echo'</script>';



}# if direct == mylog

if($direct=="class_position")
{
echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
if($right==0)
{
    $result=mysqli_query($conn,"select * from position ");
}
elseif($title=="班长")
{
    $result=mysqli_query($conn,"select * from position where (class='$class') and (school='$school') ");
}elseif($right==2)
{
    $result=mysqli_query($conn,"select * from position where school='$school' ");    
}else
{
    die("您没有查看权限");
}

#19
echo'
<script type="text/javascript">
var state_type = 0 ;
';
$number=0;
if(mysqli_num_rows($result)==0)
{
echo'
state_type=1;
';
}
else
{
echo'var content = [';
$temp = 0;
while($row=mysqli_fetch_array($result))
{
    if($temp==0)
    {
        echo'[';
        $temp=1;
    }
    else
    {
        echo',[';
    }
    $student_num=$row['student_num'];
    $name=$row['name'];
    $school=$row['school'];
    $class=$row['class'];
    $provience=$row['provience'];
    $city=$row['city'];
    $zone=$row['zone'];
    $atschool=$row['atschool'];
    $number=$number+1;
    $border=$row['border'];
    echo"'$number','$student_num' , '$name' , '$school' , '$class' , '$provience' , '$city' , '$zone' , '$atschool' , '$border'";
    echo']';
}
echo'];';
}


echo"
if(state_type==1)
{
    var content=[['无信息']];
}
";
echo'</script>';





echo'
<div class="center_right">
    <div class="table_head">
        <div class="table_head_left">
            
        </div>
        <div class="table_head_right">
        <table><tr><td>
            <p>班内成员变动情况</p>
        </td></tr></table>
        </div>
        <div class="my_download">
        <table><tr><td>
            <a href="#" onclick="my_download(content,';
            echo"'成员地理位置$now_year"."_$now_month"."_$now_day.xlsx'"; echo'
            )">点此下载班内成员信息</a>
        </td></tr></table>
        </div>
    </div>
    <div id="table_body">
        <table>
            <tr>
                <th>序号</th>
                <th>学号</th>
                <th>姓名</th>
                <th>学院</th>
                <th>班级</th>
                <th>所在省份</th>
                <th>所在市</th>
                <th>所在区</th>
                <th>在校状态</th>
                <th>境外状态</th>
            </tr>
            <tr v-for="row in datas">
                <td v-for="col in row">{{ col }}</td>
            </tr>
        </table>
    </div>
    <div class="page_change">
        <div class="page_change_left">
            <span>
            <span>前往第</span><input type="text" id="input_page"><span>页</span>
            </span>
            <span>
            <span>一页显示</span><input type="text" id="row_one_page"><span>条</span>
            </span>
            <span>
            <span>搜索</span><input type="text" id="student_name" placeholder="姓名或学号"><span>同学信息</span>
            </span>
        </div>
        <div id="back">
        <table><tr><td>
            <p id="back_page" v-if="seen">上一页</p>
        </table></tr></td>
        </div>
        <div id="next">
        <table><tr><td>
            <p id="next_page" v-if="seen">下一页</p>
        </table></tr></td>
        </div>
    </div>
</div>
';
echo'<script type="text/javascript">';
echo"
var back_page = new Vue({
    el:'#back_page',
    data:{
        seen:true
    }
})
var next_page = new Vue({
    el:'#next_page',
    data:{
        seen:true
    }
})
var now_page=1;
var list_one_page = 8;
var now_content = to_page(content,now_page,list_one_page);
var table_body = new Vue({
    el:'#table_body',
    data:{
        datas:now_content
    }
})
var last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
    next_page.seen=false;
}


\$('#back').hover(
    function mouseover() {\$('#back_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#back_page').css('color','#FF6347');}
);
\$('#next').hover(
    function mouseover() {\$('#next_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#next_page').css('color','#FF6347');}
);
\$('#back').click(
function(){
if(now_page>=2)
{
now_page=now_page-1;
}
if(now_page==1)
{
    
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
\$('#next').click(
function(){
if(now_page<last_page)
{
    now_page=now_page+1;
}
if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
";


echo"

$('#student_name').change(function() {
var input_value=$('#student_name').val();
if(input_value!='')
{
table_body.datas=my_which(content,2,input_value);
if(table_body.datas==undefined)
{
table_body.datas=my_which(content,1,input_value);  
}
}else
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,1,list_one_page);
    table_body.datas=new_content;
    }
}
})



$('#input_page').change(function() {
var input_value=parseInt($('#input_page').val());



if(input_value<1 || input_value>last_page)
{
    alert('查无此页');
}else
{
    now_page=input_value;
    
    
    
    if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
}
});


$('#row_one_page').change(function() {
var input_value=parseInt($('#row_one_page').val());
if(input_value<1)
{
    alert('一页不能少于一个');
}else
{
now_page=1;
list_one_page = input_value;
var now_content = to_page(content,now_page,list_one_page);
table_body.datas=now_content;
last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
    next_page.seen=false;
} 
}
});


";


echo'</script>';



}# if direct == class_position

if($direct=="class_log")
{
echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
if($right==0)
{
$result=mysqli_query($conn,"select * from log order by num desc");    
}elseif($right==2)
{
$result=mysqli_query($conn,"select * from log where school='$school' order by num desc");
}elseif($title=="班长")
{
$result=mysqli_query($conn,"select * from log where class='$class' order by num desc");
}else
{
die("你没有相应权限");
}

#19
echo'
<script type="text/javascript">
var state_type = 0 ;
';

if(mysqli_num_rows($result)==0)
{
echo'
state_type=1;
';
}
else
{
echo'var content = [';
$temp = 0;
while($row=mysqli_fetch_array($result))
{
    if($temp==0)
    {
        echo'[';
        $temp=1;
    }
    else
    {
        echo',[';
    }
    $student_num=$row['student_num'];
    $name=$row['name'];
    $this_num=$row['num'];
    $school=$row['school'];
    $class=$row['class'];
    $from_prov=$row['from_prov'];
    $from_city=$row['from_city'];
    $from_zone=$row['from_zone'];
    $from_border=$row['from_border'];
    $from_atschool=$row['from_atschool'];
    $to_prov=$row['to_prov'];
    $to_city=$row['to_city'];
    $to_zone=$row['to_zone'];
    $to_border=$row['to_border'];
    $to_atschool=$row['to_atschool'];
    $time=$row['time'];
    $operator=$row['operator'];
    $year=$row['year'];
    $month=$row['month'];
    $day=$row['day'];
    $temp_form='<form action="delete.php" method="post"><input type="hidden" name="delete_num" value="'.$this_num.'" ><button type="submit" value="Submit">撤回</button></form>';
    echo"'$student_num' , '$name' ,'$school', '$class' , '$from_prov' , '$from_city' , '$from_zone' , '$from_border' ,'$from_atschool', '$to_prov' , '$to_city' , '$to_zone' , '$to_border' ,'$to_atschool', '$time' , '$operator' , '$year' , '$month' , '$day','$temp_form'";
    echo']';
}
echo'];';
}



echo"
if(state_type==1)
{
    var content=[['无信息']];
}
";
echo'</script>';





echo'
<div class="center_right">
    <div class="table_head">
        <div class="table_head_left">
            
        </div>
        <div class="table_head_right">
        <table><tr><td>
            <p>班内成员变动情况</p>
        </td></tr></table>
        </div>
        <div class="my_download">
        <table><tr><td>
            <a href="#" onclick="my_download(content,';
            echo"'成员变动情况$now_year"."_$now_month"."_$now_day.xlsx'"; echo'
            )">点此下载变动记录</a>
        </td></tr></table>
        </div>
    </div>
    <div id="table_body">
        <table>
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>学院</th>
                <th>班级</th>
                <th>出发省</th>
                <th>出发市</th>
                <th>出发区</th>
                <th>境外所在</th>
                <th>在校(前)</th>
                <th>到达省</th>
                <th>到达市</th>
                <th>到达区</th>
                <th>到达境外</th>
                <th>在校(后)</th>
                <th>操作时间</th>
                <th>操作者</th>
                <th>变动年</th>
                <th>月</th>
                <th>日</th>
                <th>撤回</th>
            </tr>
            <tr v-for="row in datas">
                <td v-for="col in row" v-html="col"></td>
            </tr>
        </table>
    </div>
    <div class="page_change">
        <div class="page_change_left">
            <span>
            <span>一页显示</span><input type="text" id="row_one_page"><span>条</span>
            </span>
            <span>
            <span>搜索</span><input type="text" id="student_name" placeholder="姓名或学号"><span>同学</span>
            <span>搜索</span><input type="text" id="search_month" placeholder="几"><span>月</span>
            <input type="text" id="search_day" placeholder="几"><span>日</span>
            </span>
        </div>
        <div id="back">
        <table><tr><td>
            <p id="back_page" v-if="seen">上一页</p>
        </table></tr></td>
        </div>
        <div id="next">
        <table><tr><td>
            <p id="next_page" v-if="seen">下一页</p>
        </table></tr></td>
        </div>
    </div>
</div>
';
echo'<script type="text/javascript">';
echo"
var back_page = new Vue({
    el:'#back_page',
    data:{
        seen:true
    }
})
var next_page = new Vue({
    el:'#next_page',
    data:{
        seen:true
    }
})
var now_page=1;
var list_one_page = 3;
var now_content = to_page(content,now_page,list_one_page);
var table_body = new Vue({
    el:'#table_body',
    data:{
        datas:now_content
    }
})
var last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
next_page.seen=false; 
}


\$('#back').hover(
    function mouseover() {\$('#back_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#back_page').css('color','#FF6347');}
);
\$('#next').hover(
    function mouseover() {\$('#next_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#next_page').css('color','#FF6347');}
);
\$('#back').click(
function(){
if(now_page>=2)
{
now_page=now_page-1;   
}
if(now_page==1)
{
    
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;        
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
\$('#next').click(
function(){
if(now_page<last_page)
{
    now_page=now_page+1;
}
if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
";

echo"

$('#student_name').change(function() {
var input_value=$('#student_name').val();
if(input_value!='')
{
table_body.datas=my_which(content,1,input_value);
if(table_body.datas==undefined)
{
table_body.datas=my_which(content,1,input_value);  
}
}else
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,1,list_one_page);
    table_body.datas=new_content;
    }
}
})



$('#search_month').change(function() {
var input_month=$('#search_month').val();
var input_day=$('#search_day').val();
if(input_month!=''&&input_day!='')
{
new_content=my_which(content,17,input_month);
new_content=my_which(new_content,18,input_day);
table_body.datas=new_content;
table_body.datas=to_page(new_content,now_page,list_one_page);
content=new_content;
}else
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,1,list_one_page);
    table_body.datas=new_content;
    }
}

})

$('#input_page').change(function() {
var input_value=parseInt($('#input_page').val());



if(input_value<1 || input_value>last_page)
{
    alert('查无此页');
}else
{
    now_page=input_value;
    
    
    
    if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
}
});


$('#row_one_page').change(function() {
var input_value=parseInt($('#row_one_page').val());
if(input_value<1)
{
    alert('一页不能少于一个');
}else
{
now_page=1;
list_one_page = input_value;
var now_content = to_page(content,now_page,list_one_page);
table_body.datas=now_content;
last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
    next_page.seen=false;
} 
}
});


";
echo'</script>';



}# if direct == class_log

if($direct=="today_log")
{
echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
if($right==0)
{
$result=mysqli_query($conn,"select * from log order by num desc");    
}elseif($right==2)
{
$result=mysqli_query($conn,"select * from log where school='$school' order by num desc");
}elseif($title=="班长")
{
$result=mysqli_query($conn,"select * from log where class='$class' order by num desc");
}else
{
die("你没有相应权限");
}

#19
echo'
<script type="text/javascript">
var state_type = 0 ;
';

if(mysqli_num_rows($result)==0)
{
echo'
state_type=1;
';
}
else
{
echo'var content = [';
$temp = 0;
while($row=mysqli_fetch_array($result))
{
    $year=$row['year'];
    $month=$row['month'];
    $day=$row['day'];
    $temp_day=0;
    if($year==$now_year&&$month==$now_month&&$day==$now_day){$temp_day=1;}
if($temp_day==1)
{
    if($temp==0)
    {
        echo'[';
        $temp=1;
    }
    else
    {
        echo',[';
    }
    $student_num=$row['student_num'];
    $name=$row['name'];
    $this_num=$row['num'];
    $school=$row['school'];
    $class=$row['class'];
    $from_prov=$row['from_prov'];
    $from_city=$row['from_city'];
    $from_zone=$row['from_zone'];
    $from_border=$row['from_border'];
    $from_atschool=$row['from_atschool'];
    $to_prov=$row['to_prov'];
    $to_city=$row['to_city'];
    $to_zone=$row['to_zone'];
    $to_border=$row['to_border'];
    $to_atschool=$row['to_atschool'];
    $time=$row['time'];
    $operator=$row['operator'];
    $temp_form='<form action="delete.php" method="post"><input type="hidden" name="delete_num" value="'.$this_num.'" ><button type="submit" value="Submit">撤回</button></form>';
    echo"'$student_num' , '$name' ,'$school', '$class' , '$from_prov' , '$from_city' , '$from_zone' , '$from_border' ,'$from_atschool', '$to_prov' , '$to_city' , '$to_zone' , '$to_border' ,'$to_atschool', '$time' , '$operator' , '$year' , '$month' , '$day','$temp_form'";
    echo']';
}
}
echo'];';
}



echo"
if(state_type==1)
{
    var content=[['无信息']];
}
";
echo'</script>';





echo'
<div class="center_right">
    <div class="table_head">
        <div class="table_head_left">
            
        </div>
        <div class="table_head_right">
        <table><tr><td>
            <p>班内成员变动情况</p>
        </td></tr></table>
        </div>
        <div class="my_download">
        <table><tr><td>
            <a href="#" onclick="my_download(content,';
            echo"'本日成员变动情况$now_year"."_$now_month"."_$now_day.xlsx'"; echo'
            )">点此下载本日记录</a>
        </td></tr></table>
        </div>
    </div>
    <div id="table_body">
        <table>
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>学院</th>
                <th>班级</th>
                <th>出发省</th>
                <th>出发市</th>
                <th>出发区</th>
                <th>境外所在</th>
                <th>在校(前)</th>
                <th>到达省</th>
                <th>到达市</th>
                <th>到达区</th>
                <th>到达境外</th>
                <th>在校(后)</th>
                <th>操作时间</th>
                <th>操作者</th>
                <th>变动年</th>
                <th>月</th>
                <th>日</th>
                <th>撤销</th>
            </tr>
            <tr v-for="row in datas">
                <td v-for="col in row" v-html="col"></td>
            </tr>
        </table>
    </div>
    <div class="page_change">
        <div class="page_change_left">
            <span>
            <span>前往第</span><input type="text" id="input_page"><span>页</span>
            </span>
            <span>
            <span>一页显示</span><input type="text" id="row_one_page"><span>条</span>
            </span>
            <span>
            <span>搜索</span><input type="text" id="student_name" placeholder="姓名或学号"><span>同学信息</span>
            </span>
        </div>
        <div id="back">
        <table><tr><td>
            <p id="back_page" v-if="seen">上一页</p>
        </table></tr></td>
        </div>
        <div id="next">
        <table><tr><td>
            <p id="next_page" v-if="seen">下一页</p>
        </table></tr></td>
        </div>
    </div>
</div>
';
echo'<script type="text/javascript">';
echo"
var back_page = new Vue({
    el:'#back_page',
    data:{
        seen:true
    }
})
var next_page = new Vue({
    el:'#next_page',
    data:{
        seen:true
    }
})
var now_page=1;
var list_one_page = 3;
var now_content = to_page(content,now_page,list_one_page);
var table_body = new Vue({
    el:'#table_body',
    data:{
        datas:now_content
    }
})
var last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
next_page.seen=false; 
}


\$('#back').hover(
    function mouseover() {\$('#back_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#back_page').css('color','#FF6347');}
);
\$('#next').hover(
    function mouseover() {\$('#next_page').css('color','#556B2F');}, 
    function mouseout()  {\$('#next_page').css('color','#FF6347');}
);
\$('#back').click(
function(){
if(now_page>=2)
{
now_page=now_page-1;   
}
if(now_page==1)
{
    
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;        
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
\$('#next').click(
function(){
if(now_page<last_page)
{
    now_page=now_page+1;
}
if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
});
";
echo"

$('#student_name').change(function() {
var input_value=$('#student_name').val();
if(input_value!='')
{
table_body.datas=my_which(content,1,input_value);
if(table_body.datas==undefined)
{
table_body.datas=my_which(content,1,input_value);  
}
}else
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,1,list_one_page);
    table_body.datas=new_content;
    }
}
})





$('#input_page').change(function() {
var input_value=parseInt($('#input_page').val());



if(input_value<1 || input_value>last_page)
{
    alert('查无此页');
}else
{
    now_page=input_value;
    
    
    
    if(now_page==1)
{
    back_page.seen=false;
    if(last_page>1)
    {
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
    }
}

if(now_page==last_page)
{
    next_page.seen=false;
    back_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}

if(now_page>1 && now_page<last_page)
{
    back_page.seen=true;
    next_page.seen=true;
    new_content=to_page(content,now_page,list_one_page);
    table_body.datas=new_content;
}
}
});


$('#row_one_page').change(function() {
var input_value=parseInt($('#row_one_page').val());
if(input_value<1)
{
    alert('一页不能少于一个');
}else
{
now_page=1;
list_one_page = input_value;
var now_content = to_page(content,now_page,list_one_page);
table_body.datas=now_content;
last_page = last_page(content,list_one_page);
back_page.seen=false;
if(last_page==1)
{
    next_page.seen=false;
} 
}
});


";
echo'</script>';



}# if direct == today_log

if($direct=="class_change")
{
$year=date("Y");
$month=date("m");
$day=date("j");
echo'<link rel="stylesheet" href="../css/class_change_right.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}

if($right==0)
{
    $result=mysqli_query($conn,"select * from users");
}elseif($right==2)
{
    $result=mysqli_query($conn,"select * from users where school='$school'");
}elseif($title=="班长")
{
    $result=mysqli_query($conn,"select * from users where class='$class'");
}else
{
    die("你没有相应权限");
}



echo'<script type="text/javascript">';
echo"var content = [";
$temp=0;
while($row=mysqli_fetch_array($result))
{
    $temp_name=$row['name'];
    $temp_student_num=$row['student_num'];
    if($temp==0)
    {
        echo'[';
        $temp=1;
    }else
    {
        echo',[';
    }
    echo"'$temp_name','$temp_student_num']";
}
echo"]";
echo'</script>';





echo'<div class="change">';
echo'<script type="text/javascript">';
$result=mysqli_query($conn,"select * from proviences");
$row=mysqli_fetch_array($result);
$provience=$row['provience'];
$city=$row['city'];
$zone=$row['zone'];

echo'var proviences = [["',$provience,'","',$city,'","',$zone,'"]];';
while($row=mysqli_fetch_array($result))
{
$provience=$row['provience'];
$city=$row['city'];
$zone=$row['zone'];
echo'proviences.push(["',$provience,'","',$city,'","',$zone,'"]);';
}
echo'</script>';

echo'
<div id="form">
    <form class="position_change_form" action="process.php" method="post" onSubmit="return normal_check(this)">
        <input type="hidden" name="posttype" value="change_position">
        <div class="form_title">
            <p>请在下方填写你的地理位置变动信息</p>
            <p style="color:red;">请注意：本系统无需等待同学到位再报送,可以提前报送</p>
        </div>
        <div class="student_num_div">
            <span>学号:</span>
            <input type="text" name="change_student_num" value="20" id="change_student_num"> 
        </div>
        <div id="app_1">
            <table><tr><td>
            <p>{{ message }}</p>
            </td></tr></table>
        </div>
        <div id="select1">
            <span>省份:</span>
            <select name="select1" id="select_1">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select2">
            <span>城市:</span>
            <select name="select2" id="select_2">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select3">
            <span>区:</span>
            <select name="select3" id="select_3">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select4">
            <span>在校状态:</span>
            <select name="select4" id="select_4">
                <option>不在校</option>
                <option>在校</option>
            </select>
        </div>
        <div id="select5">
            <span>变动时间(年):</span>
            <select name="select5" id="select_5">
                <option>2021</option>
                <option>2020</option>
                <option>2022</option>
            </select>
        </div>
        <div id="select6">
            <span>月:</span>
            <select name="select6" id="select_6">';
            
for($temp=1;$temp<13;$temp++)
{
if($month==$temp)
{echo'<option value="';echo"$temp";echo'" selected="selected">';echo"$temp";echo'</option>';}
elseif($student_num=='1000')
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
elseif($month<$temp)
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
}


echo'
            </select>
        </div>
        <div id="select7">
            <span>日:</span>
            <select name="select7" id="select_7">
';


for($temp=1;$temp<32;$temp++)
{
if($day==$temp)
{echo'<option value="';echo"$temp";echo'" selected="selected">';echo"$temp";echo'</option>';}
elseif($student_num=='1000')
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
elseif($day<$temp)
{echo'<option value="';echo"$temp";echo'">';echo"$temp";echo'</option>';}
}


echo'
            </select>
        </div>
        <div class="add">
            <span>备注:</span>
            <input type="text" name="add" value="无"> 
        </div>
        <div id="form_border" v-if="seen">
            <span>具体位置:</span>
            <input type="text" name="border" value="在境内">
        </div>
        <div class="button_div">    
            <button class="button" id="position_button" type="submit">提交</button>
        </div>
    </form>
</div>
';

echo'
<script type="text/javascript">
var a = my_unique(fetch_col(proviences,0));
var b = my_unique(fetch_col(proviences,1));
var c = my_unique(fetch_col(proviences,2));';
echo"
var select_1 = new Vue({
  el: '#select_1',
  data: {
    list: a
}
})
var select_2 = new Vue({
  el: '#select_2',
  data: {
    list: b
}
})
var select_3 = new Vue({
  el: '#select_3',
  data: {
    list: c
  }
})
var border = new Vue({
    el:'#form_border',
    data:{
        seen:false
    }
})
var app1 = new Vue({
    el:'#app_1',
    data:{
        message:'嗨，这里会显示同学信息'
    }
})

$('#change_student_num').change(function() {
var temp=my_which(content,1,$('#change_student_num').val());
if(temp!=undefined)
{
app1.message='这位同学是:  '+String(temp[0][0]);   
}
});

var temp=$('#select_1').val();
var temp2=$('#select_2').val();
var temp3=$('#select_1').val();
var new_proviences=proviences;
$('#select_1').change(function() {
temp=$('#select_1').val();
new_proviences=my_which(proviences,0,temp);
b = my_unique(fetch_col(new_proviences,1));
c = my_unique(fetch_col(new_proviences,2));
select_2.list=b;
select_3.list=c;
});
$('#select_2').change(function() {
temp2=$('#select_2').val();
new_proviences2=my_which(new_proviences,1,temp2);
c = my_unique(fetch_col(new_proviences2,2));
select_3.list=c;
});
$('#select_1').change(function(){
if($('#select_1').val()=='国外')
{
    border.seen=true;
} 
})
$('#select_1').change(function(){
if($('#select_1').val()=='港澳台')
{
    border.seen=true;
} 
})

function normal_check(form)
{
    if($('#select_1').val()!='北京市' && $('#select_4').val()=='在校')
    {
    alert('不在北京不可能在校，请检查输入');
    $('#select_1').css('background-color','#FFF0F5');
    $('#select_4').css('background-color','#FFF0F5');
    return(false);
    }
    if($('#border').val()=='在境内')
    {
    alert('请认真填写所在地');
    $('#border').css('background-color','#FFF0F5');
    return(false);
    }
    if($('#border').val()=='')
    {
        alert('这个不可以不填哦');
        $('#border').css('background-color','#FFF0F5');
        return(false);
    }
    return(true);
}
$('#position_button').hover(
    function mouseover() {\$('#position_button').css('color','#00FA9A');}, 
    function mouseout()  {\$('#position_button').css('color','white');}
);
</script>";



echo'</div>';
$my_student_num=$student_num;
$result=mysqli_query($conn,"select * from log where operator='$student_num'");
$result2=mysqli_query($conn,"select * from log where operator='$student_num' order by num desc");
;
if($row2=mysqli_fetch_array($result2))
{
$name=$row2['name'];
$student_num=$row2['student_num'];
$year=$row2['year'];
$month=$row2['month'];
$day=$row2['day'];
$from_prov=$row2['from_prov'];
$from_city=$row2['from_city'];
$from_zone=$row2['from_zone'];
$from_border=$row2['from_border'];
$to_prov=$row2['to_prov'];
$to_city=$row2['to_city'];
$to_zone=$row2['to_zone'];
$to_border=$row2['to_border'];
$time=$row2['time'];
$operator=$row2['operator'];
if($operator==$my_student_num)
{
    $operator="由你迁移";
}
else
{
    $operator="由他人迁移";
}
echo'
<div class="center_right_bottom">
    <table class="center_right_bottom">
        <tr class="center_right_bottom_tr">
            <td colspan="7" class="wid_td">
                班内成员上次变更情况
            </td>
        </tr>
        <tr class="center_right_bottom_tr">
';

echo'<td class="center_right_bottom_td1">';
echo"$name $student_num";
echo'</td>';
echo'<td class="center_right_bottom_td1">';
echo"从";
echo'</td>';
echo'<td class="center_right_bottom_td2">';
echo"$from_prov";
echo'</td>';
echo'<td class="center_right_bottom_td3">';
echo"$from_city";
echo'</td>';
echo'<td class="center_right_bottom_td4">';
echo"$from_zone";
echo'</td>';
echo'<td class="center_right_bottom_td5">';
echo"$from_border";
echo'</td>';
echo'<td class="center_right_bottom_td6">';
echo"操作时间为:$time";
echo'</td>';
echo'</tr>';

echo'<tr class="center_right_bottom_tr">';
echo'<td class="center_right_bottom_td1">';
echo"$year 年 $month 月 $day 日";
echo'</td>';
echo'<td class="center_right_bottom_td1">';
echo"至";
echo'</td>';
echo'<td class="center_right_bottom_td2">';
echo"$to_prov";
echo'</td>';
echo'<td class="center_right_bottom_td3">';
echo"$to_city";
echo'</td>';
echo'<td class="center_right_bottom_td4">';
echo"$to_zone";
echo'</td>';
echo'<td class="center_right_bottom_td5">';
echo"$to_border";
echo'</td>';
echo'<td class="center_right_bottom_td6">';
echo"$operator";
echo'</td>';
echo'</tr>';



echo'
    </table>
</div>
';
}else
{
echo"$row";
echo'
<div class="center_right_bottom">
    <table class="center_right_bottom">
        <tr class="center_right_bottom_tr">
            <td colspan="6" class="wid_td">
                您没提交过位置变动
            </td>
        </tr>
    </table>
</div>
';  
}






}# if direct == class_change

if($direct=="stat")
{

echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}

if($right==1)
{
    if($title!="班长")
    {
        die("你没有相关权限");
    }
}


$result=mysqli_query($conn,"select * from log where state='0' ");
while($row=mysqli_fetch_array($result))
{
    $now_year=date("Y");
    $now_month=date("m");
    $now_day=date("j");  
    $this_year=$row['year'];
    $this_month=$row['month'];
    $this_day=$row['day'];
    #$this_time=strtotime($this_time);
    if($now_year>=$this_year)
    {
        if($now_month>=$this_month)
        {
            if($now_day>=$this_day||$now_month>$this_month)
            {
                
        $this_to_prov=$row['to_prov'];
        $this_to_city=$row['to_city'];
        $this_to_zone=$row['to_zone'];
        $this_to_border=$row['to_border'];
        $this_to_atschool=$row['to_atschool'];
        $this_student_num=$row['student_num'];
        $this_num=$row['num'];
        $result2=mysqli_query($conn,"update position set provience='$this_to_prov',city='$this_to_city',zone='$this_to_zone',atschool='$this_to_atschool',border='$this_to_border' where student_num='$this_student_num' ");
        $result_info2 = mysqli_affected_rows($conn);
        $result3=mysqli_query($conn,"update log set state='1' where num='$this_num' ");        
        $result_info3 = mysqli_affected_rows($conn);
        if($result_info2!=1 && $result_info3!=1)
        {
            die("数据库刷坏了，请告知管理员");
        }
        
            }
        }
    }
}


$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
if($right==1 && $title!="班长")
{
    die("您没有查看权限");    
}

$result=mysqli_query($conn,"select * from position ");
$count_beijing=0;
$count_atschool=0;
$at_school_ben=0;
$at_school_shuo=0;
$at_school_bo=0;
$count_border=0;
$count_foreign=0;
$count_all=0;
$at_school_vaccine=0;
$beijing_vaccine=0;
$other_vaccine=0;
while($row=mysqli_fetch_array($result))
{
if($row['class']!="教师" && $row['class']!="管理员")
{


if($right==0)
{
include('count.php');
}
elseif($right==1 && $title=="班长")
{
    $this_class=$row['class'];
    if($class==$this_class)
    {
        include('count.php');
    }
}
elseif($right==2)
{
    $this_school=$row['school'];
    if($school==$this_school)
    {
        include('count.php');
    }
}

}
}

echo'<div id="table_body2">';
$total_beijing=$count_beijing+$count_atschool;
$other_prov=$count_all-$total_beijing-$count_border-$count_foreign;
echo"
<table>
    <tr>
        <td>在京在校人数</td>
        <td>在京在校本科人数</td>
        <td>在京在校硕士人数</td>
        <td>在京在校博士人数</td>
        <td>在京不在校人数</td>
    </tr>
    <tr>
        <td>$count_atschool</td>
        <td>$at_school_ben</td>
        <td>$at_school_shuo</td>
        <td>$at_school_bo</td>
        <td>$count_beijing</td>
    </tr>
    <tr>
        <td>在京人数</td>
        <td>在其他省份人数</td>
        <td>在港澳台人数</td>
        <td>在国外人数</td>
        <td>总人数</td>
    </tr>
    <tr>
        <td>$total_beijing</td>
        <td>$other_prov</td>
        <td>$count_border</td>
        <td>$count_foreign</td>
        <td>$count_all</td>
    </tr>
        <tr>
        <td>在京在校接种数</td>
        <td>在京不在校接种数</td>
        <td>在其他省份接种数</td>
        <td>NULL</td>
        <td>NULL</td>
    </tr>
    <tr>
        <td>$at_school_vaccine</td>
        <td>$beijing_vaccine</td>
        <td>$other_vaccine</td>
        <td>NULL</td>
        <td>NULL</td>
    </tr>
</table>
</div>
";
}# if direct == stat

if($direct=="stat_by_time")
{
echo'<link rel="stylesheet" href="../css/stat_by_time.css" type="text/css">';
echo'<link rel="stylesheet" href="../css/position_table.css" type="text/css">';
$conn =mysqli_connect("localhost","root","zx1097315797");
mysqli_select_db($conn,"RSS");
 if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
if (isset($_POST['year']))
{
$select_year=$_POST['year'];
$select_month=$_POST['month'];
$select_day=$_POST['day'];
}else
{
$select_year=date("Y");
$select_month=date("m");
$select_day=date("j");    
}
echo'
<div class="form_head">
<form class="time_form" action="position.php?direct=stat_by_time&info=true" method="post">
    <table>
        <tr>
            <td>年</td>
            <td>
                <input type="text" name="year" value="';    echo"$select_year";        echo'">
            </td>
            <td>月</td>
            <td>
                <input type="text" name="month" value="';    echo"$select_month";        echo'">
            </td>
            <td>日</td>
            <td>
                <input type="text" name="day" value="';    echo"$select_day";        echo'">
            </td>
            <td>
            <button>提交</button>
            </td>
        </tr>
    </table>
</form>
</div>
';


mysqli_query($conn,"CREATE TABLE temp_position LIKE position;");
mysqli_query($conn,"INSERT INTO temp_position SELECT * FROM position;");
$result=mysqli_query($conn,"select * from log order by num desc");

echo"
<script type='text/javascript'>
a=[['变动人次','之前所在省份','之前所在城市','之前在校状态','选择日期','调整日期']]
</script>
";

while($row=mysqli_fetch_array($result))
{
$this_year=$row['year'];
$this_month=$row['month'];
$this_day=$row['day'];
$this_name=$row['name'];
$this_student_num=$row['student_num'];
$from_prov=$row['from_prov'];
$from_city=$row['from_city'];
$from_zone=$row['from_zone'];
$from_atschool=$row['from_atschool'];

if($this_year>=$select_year)
{
    if($this_month>=$select_month)
    {
        if($this_day>$select_day||$this_month>$select_month)
        {
            mysqli_query($conn,"update temp_position set provience='$from_prov',city='$from_city',zone='$from_zone',atschool='$from_atschool' where student_num='$this_student_num' ");
echo"
<script type='text/javascript'>
a.push(['$this_name','$from_prov','$from_city','$from_atschool','$select_day','$this_day'])
</script>
";
        }
    }
}
}


if($right==1)
{
    if($title!="班长")
    {
        die("你没有相关权限");
    }
}

$result=mysqli_query($conn,"select * from log where state='0' ");
while($row=mysqli_fetch_array($result))
{
    $now_year=date("Y");
    $now_month=date("m");
    $now_day=date("j");  
    $this_year=$row['year'];
    $this_month=$row['month'];
    $this_day=$row['day'];
    #$this_time=strtotime($this_time);
    if($now_year>=$this_year)
    {
        if($now_month>=$this_month)
        {
            if($now_day>=$this_day||$now_month>$this_month)
            {
                
        $this_to_prov=$row['to_prov'];
        $this_to_city=$row['to_city'];
        $this_to_zone=$row['to_zone'];
        $this_to_border=$row['to_border'];
        $this_to_atschool=$row['to_atschool'];
        $this_student_num=$row['student_num'];
        $this_num=$row['num'];
        $result2=mysqli_query($conn,"update position set provience='$this_to_prov',city='$this_to_city',zone='$this_to_zone',atschool='$this_to_atschool',border='$this_to_border' where student_num='$this_student_num' ");
        $result_info2 = mysqli_affected_rows($conn);
        $result3=mysqli_query($conn,"update log set state='1' where num='$this_num' ");        
        $result_info3 = mysqli_affected_rows($conn);
        if($result_info2!=1 && $result_info3!=1)
        {
            die("数据库刷坏了，请告知管理员");
        }
        
            }
        }
    }
}



$result=mysqli_query($conn,"select * from temp_position ");
$count_beijing=0;
$count_atschool=0;
$at_school_ben=0;
$at_school_shuo=0;
$at_school_bo=0;
$count_border=0;
$count_foreign=0;
$count_all=0;
$at_school_vaccine=0;
$beijing_vaccine=0;
$other_vaccine=0;
while($row=mysqli_fetch_array($result))
{
if($row['class']!="教师" && $row['class']!="管理员")
{


if($right==0)
{
include('count.php');
}
elseif($right==1 && $title=="班长")
{
    $this_class=$row['class'];
    if($class==$this_class)
    {
        include('count.php');
    }
}
elseif($right==2)
{
    $this_school=$row['school'];
    if($school==$this_school)
    {
        include('count.php');
    }
}

}
}

echo'<div id="table_body2">';
$total_beijing=$count_beijing+$count_atschool;
$other_prov=$count_all-$total_beijing-$count_border-$count_foreign;
echo"
<table>
    <tr>
        <td>在京在校人数</td>
        <td>在京在校本科人数</td>
        <td>在京在校硕士人数</td>
        <td>在京在校博士人数</td>
        <td>在京不在校人数</td>
    </tr>
    <tr>
        <td>$count_atschool</td>
        <td>$at_school_ben</td>
        <td>$at_school_shuo</td>
        <td>$at_school_bo</td>
        <td>$count_beijing</td>
    </tr>
    <tr>
        <td>在京人数</td>
        <td>在其他省份人数</td>
        <td>在港澳台人数</td>
        <td>在国外人数</td>
        <td>总人数</td>
    </tr>
    <tr>
        <td>$total_beijing</td>
        <td>$other_prov</td>
        <td>$count_border</td>
        <td>$count_foreign</td>
        <td>$count_all</td>
    </tr>
        </tr>
        <tr>
        <td>在京在校接种数</td>
        <td>在京不在校接种数</td>
        <td>在其他省份接种数</td>
        <td>NULL</td>
        <td>NULL</td>
    </tr>
    <tr>
        <td>$at_school_vaccine</td>
        <td>$beijing_vaccine</td>
        <td>$other_vaccine</td>
        <td>NULL</td>
        <td>NULL</td>
    </tr>
</table>
</div>
";
mysqli_query($conn,"DROP TABLE temp_position;");
$result2=mysqli_query($conn,"select count(*) from information_schema.TABLES t where t.TABLE_SCHEMA ='RSS' and t.TABLE_NAME ='temp_position';");
$row=mysqli_fetch_array($result2);
if($row[0]!=0)
{
    echo"<script>alert('出现重大错误，问题在于删除临时数据库，请联系管理员解决');</script>";
}elseif(isset($_POST['year']))
{
    echo"<script>alert('查询成功');</script>";
}
}

echo'</div>';
}



?>