<div class="header">
    <div class="header_left">
        <img class="index_img" src="../img/index_img.png">
    </div>
    <div class="header_center">
        <p>中间还没建完</p>
        <a href="position.php">地理位置变更系统</a>
    </div>
    <div class="header_right">
        
    </div>
</div>


<script src="../js/vue.min.js"></script>

echo'
<div id="form">
    <form>
        <input type="hidden" name="posttype" value="change_position">
        <div id="select1">
            <select name="select1" id="select_1">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select2">
            <select name="select2" id="select_2">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select3">
            <select name="select3" id="select_3">
                <option :value="a" v-for="a in list">{{ a }}</option>
            </select>
        </div>
        <div id="select4">
            <select name="select4" id="select_4">
                <option>在校</option>
                <option>不在校</option>
            </select>
        </div>
        <div id="select5">
            <select name="select5" id="select_5">
                <option>在境内</option>
                <option>不在境内</option>
            </select>
        </div>
        <div class="button_div">    
            <button class="button" type="submit">提交</button>
        </div>        
    </form>
</div>
';
<script type="text/javascript">
var a=[[1,2,3,4],[3,5,7,9],[2,3,4,5]];
new Vue({
  el: '#select_1',
  data: {
    list: a[0]
}
})
new Vue({
  el: '#select_2',
  data: {
    list: a[1]
}
})
new Vue({
  el: '#select_3',
  data: {
    list: a[2]
}
})

$('#select_2').change(var function =test(){
				// console.log('change');
				// console.log($('#cont select option:selected').text());
				console.log($('#select_2 select2').val());
		});


</script>


<div class="center_right_botton">
    <table>
        <tr>
            <td colspan="5" class="wid_td">
                上次变更情况
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
</div>

