<?php $state=0;?>


<?php if($state==0): ?>
<form method="post" id="print_post" action="10.46.123.59:8000/docs" enctype="multipart/form-data">
　　<table style="display: table;">
　　　　<tr>
　　　　　　<td>文件</td>
　　　　　　<td><input type="file" id="file" name="file"></td>
　　　　</tr>
　　　　<tr>
　　　　　　<td colspan='2'>
　　　　　　　　<div>
　　　　　　　　　　<button type="button" id="submit-btn">提交</button>
　　　　　　　　</div>
　　　　　　</td>
　　　　</tr>
　　</table>
</form>
<?php endif; ?>