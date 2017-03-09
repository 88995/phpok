<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><!-- 文本表单项 -->
<?php if($_rs['form_btn'] == 'date'){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="日期" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="laydate({elem:'#<?php echo $_rs['identifier'];?>'})" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<?php }elseif($_rs['form_btn'] == "datetime"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="日期时间" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="laydate({elem:'#<?php echo $_rs['identifier'];?>',istime:true,format: 'YYYY-MM-DD hh:mm:ss'})" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<?php }elseif($_rs['form_btn'] == "file"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="文件" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn_<?php echo $_rs['identifier'];?>" />
<input type="button" value="下载" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn2_<?php echo $_rs['identifier'];?>" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<script type="text/javascript">
$(document).ready(function(){
	$("#_btn_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","input") + "&id=<?php echo $_rs['identifier'];?>";
		$.dialog.open(url,{
			title: "附件管理器",
			lock : true,
			width: "700px",
			height: "70%",
			win_min:false,
			win_max:false,
			resize: false
		});
	});

	$("#_btn2_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("res_action","download");
		var file = $("#<?php echo $_rs['identifier'];?>").val();
		if(!file)
		{
			$.dialog.alert("没有可下载的附件");
			return false;
		}
		url += "&file="+$.str.encode(file);
		window.open(url);
	});
});
</script>
<?php }elseif($_rs['form_btn'] == "image"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="选择图片" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn_<?php echo $_rs['identifier'];?>" />
<input type="button" value="预览" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn2_<?php echo $_rs['identifier'];?>" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<script type="text/javascript">
$(document).ready(function(){
	$("#_btn_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","input") + "&id=<?php echo $_rs['identifier'];?>&type=image";
		$.dialog.open(url,{
			title: "图片管理器",
			lock : true,
			width: "700px",
			height: "70%",
			win_min:false,
			win_max:false,
			resize: false
		});
	});

	$("#_btn2_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("res_action","view");
		var file = $("#<?php echo $_rs['identifier'];?>").val();
		if(!file)
		{
			$.dialog.alert("没有指定图片");
			return false;
		}
		url += "&file="+$.str.encode(file);
		$.dialog.open(url,{
			title: '预览图片',
			lock: true,
			width: '700px',
			height: '70%',
			win_min:false,
			win_max:false,
			resize: false,
			ok: function(){}
		});
	});
});
</script>
<?php }elseif($_rs['form_btn'] == "video"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="选择视频" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn_<?php echo $_rs['identifier'];?>" />
<input type="button" value="预览" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn2_<?php echo $_rs['identifier'];?>" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<script type="text/javascript">
$(document).ready(function(){
	$("#_btn_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","input") + "&id=<?php echo $_rs['identifier'];?>&type=video";
		$.dialog.open(url,{
			title: "视频管理器",
			lock : true,
			width: "700px",
			height: "70%",
			win_min:false,
			win_max:false,
			resize: false
		});
	});

	$("#_btn2_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("res_action","video");
		var file = $("#<?php echo $_rs['identifier'];?>").val();
		if(!file)
		{
			$.dialog.alert("没有指定视频");
			return false;
		}
		url += "&file="+$.str.encode(file);
		$.dialog.open(url,{
			title: '试播',
			lock: true,
			width: '700px',
			height: '430px',
			win_min:false,
			win_max:false,
			resize: false,
			ok: function(){}
		});
	});
});
</script>
<?php }elseif($_rs['form_btn'] == "url"){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="首页" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn_<?php echo $_rs['identifier'];?>" />
<input type="button" value="网址库" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn2_<?php echo $_rs['identifier'];?>" />
<input type="button" value="访问" class="btn btn_<?php echo $_rs['identifier'];?>" id="_btn3_<?php echo $_rs['identifier'];?>" />
<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
<script type="text/javascript">
$(document).ready(function(){
	//点击首页时
	$("#_btn_<?php echo $_rs['identifier'];?>").click(function(){
		$("#<?php echo $_rs['identifier'];?>").val('index.php');
	});
	//点击网址库时弹出窗口进行选择
	$("#_btn2_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","url") + "&id=<?php echo $_rs['identifier'];?>";
		$.dialog.open(url,{
			title: "网址管理器",
			lock : true,
			width: "700px",
			height: "70%",
			win_min:false,
			win_max:false,
			resize: false
		});
	});
	//访问填写的地址
	$("#_btn3_<?php echo $_rs['identifier'];?>").click(function(){
		var url = $("#<?php echo $_rs['identifier'];?>").val();
		if(!url || url == "http://" || url == "https://")
		{
			$.dialog.alert("未指定网址");
			return false;
		}
		window.open(url);
	});
});
</script>
<?php }elseif($_rs['form_btn'] == "user"){ ?>
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
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?> color {pickerClosable:true,pickerPosition:'right',required:false}" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<?php } else { ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<?php } ?>
<?php if($_rs['ext_quick_words']){ ?>
<script type="text/javascript">
function _obj_quick_insert_<?php echo $_rs['identifier'];?>(val)
{
	var linkid = "<?php echo $_rs['ext_quick_type'];?>";
	if(linkid == 'none')
	{
		$("#<?php echo $_rs['identifier'];?>").val(val);
	}
	else
	{
		var tmp = $("#<?php echo $_rs['identifier'];?>").val();
		if(tmp)
		{
			tmp = tmp + "" +linkid + ""+val;
		}
		else
		{
			tmp = val;
		}
		$("#<?php echo $_rs['identifier'];?>").val(tmp);
	}
}
</script>
	<?php if(!$_rs['form_btn']){ ?>
	<input type="button" value="清除" class="btn btn_<?php echo $_rs['identifier'];?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');" />
	<?php } ?>
<div style="padding-top:5px;">
	<?php $_rs_ext_quick_words_id["num"] = 0;$_rs['ext_quick_words']=is_array($_rs['ext_quick_words']) ? $_rs['ext_quick_words'] : array();$_rs_ext_quick_words_id["total"] = count($_rs['ext_quick_words']);$_rs_ext_quick_words_id["index"] = -1;foreach($_rs['ext_quick_words'] AS $key=>$value){ $_rs_ext_quick_words_id["num"]++;$_rs_ext_quick_words_id["index"]++; ?>
	<?php if($key){ ?>，<?php } ?><span style="cursor:pointer;" onclick="_obj_quick_insert_<?php echo $_rs['identifier'];?>('<?php echo $value;?>')"><?php echo $value;?></span>
	<?php } ?>
</div>
<?php } ?>