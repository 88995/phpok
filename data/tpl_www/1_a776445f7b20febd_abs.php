<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php if($_rs['form_btn'] == 'date'){ ?>
<script type="text/javascript" src="<?php echo $_js;?>/laydate/laydate.js"></script>
<input type="text" id="<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value=" 日期 " onclick="laydate({elem:'#<?php echo $_rs['identifier'];?>'})" />
<input type="button" value=" 清除 " onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<?php }elseif($_rs['form_btn'] == "datetime"){ ?>
<script type="text/javascript" src="<?php echo $_js;?>/laydate/laydate.js"></script>
<input type="text" id="<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value=" 日期时间 " onclick="laydate({elem:'#<?php echo $_rs['identifier'];?>',istime:true,format: 'YYYY-MM-DD hh:mm:ss'})" />
<input type="button" value=" 清除 " onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<?php }elseif($_rs['form_btn'] == "file"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="会员库" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn_<?php echo $_rs['identifier'];?>" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<script type="text/javascript">
$(document).ready(function(){
	$("#_btn_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","user2") + "&id=<?php echo $_rs['identifier'];?>";
		$.dialog.open(url,{
			title: "会员列表",
			lock : true,
			width: "700px",
			height: "70%",
			resize: false
		});
	});
});
</script>
<?php }elseif($_rs['form_btn'] == 'color'){ ?>
<script type="text/javascript" src="<?php echo $_js;?>/jscolor/jscolor.js"></script>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="color {pickerClosable:true,pickerPosition:'right',required:false}" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<?php } else { ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" placeholder="<?php echo $_rs['note'];?>" />
<?php } ?>
