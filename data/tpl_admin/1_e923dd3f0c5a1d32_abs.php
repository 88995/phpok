<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><input type="hidden" name="<?php echo $_rs['identifier'];?>" id="<?php echo $_rs['identifier'];?>" value="<?php echo $_rs['content'];?>" />
<input type="hidden" id="<?php echo $_rs['identifier'];?>_status" value="" />
<style type="text/css">
.<?php echo $_rs['identifier'];?>_thumb{float:left;width:144px;margin:3px 5px;padding:1px;border:1px solid #ccc;border-radius:3px;position:relative;}
.<?php echo $_rs['identifier'];?>_thumb .sort{position:absolute;right:5px;top:5px;}
.<?php echo $_rs['identifier'];?>_thumb .sort input.taxis{width:40px;border:1px solid #ccc;border-radius:3px;height:22px;text-align:center;padding:3px;}
</style>
<div class="_e_upload">
	<div class="_select">
		<table>
		<tr>
			<td><div id="<?php echo $_rs['identifier'];?>_picker"></div></td>
			<?php if(!$_rs['upload_auto']){ ?>
			<td><button id="<?php echo $_rs['identifier'];?>_submit" type="button" class="button"><?php echo P_Lang("开始上传");?></button></td>
			<?php } ?>
			<td><button id="select_res_<?php echo $_rs['identifier'];?>" class="button" type="button"><?php echo P_Lang("选择");?><?php echo $_rs['upload_type']['title'];?></button></td>
			<td id="<?php echo $_rs['identifier'];?>_sort" style="display:none">
				<button onclick="obj_<?php echo $_rs['identifier'];?>.sort()" class="button" type="button"><?php echo P_Lang("排序");?></button>
				<button onclick="obj_<?php echo $_rs['identifier'];?>.sort('title')" class="button" type="button"><?php echo P_Lang("自然排序");?></button>
			</td>
			<td><div class="gray i" style="line-height:180%;"><?php echo P_Lang("支持格式有：");?><?php echo $_rs['upload_type']['swfupload'];?></div></td>
		</tr>
		</table>
	</div>
	<div class="_progress" id="<?php echo $_rs['identifier'];?>_progress"></div>
	<div class="_list" id="<?php echo $_rs['identifier'];?>_list"></div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
var obj_<?php echo $_rs['identifier'];?>;
$(document).ready(function(){
	//清空本地存储，防止异常删除
	$.dialog.data('upload-<?php echo $_rs['identifier'];?>','');
	obj_<?php echo $_rs['identifier'];?> = new $.admin_upload({
		'id':'<?php echo $_rs['identifier'];?>',
		'swf':'js/webuploader/uploader.swf',
		'server':'<?php echo $sys['url'];?><?php echo phpok_url(array('ctrl'=>'upload','func'=>'save','cateid'=>$_rs['cate_id']));?>',
		'pick':{'id':'#<?php echo $_rs['identifier'];?>_picker','multiple':<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>},
		'resize':false,
		'multiple':"<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>",
		"formData":{'<?php echo session_name();?>':'<?php echo session_id();?>'},
		'fileVal':'upfile',
		'disableGlobalDnd':true,
		'compress':false,
		'auto':<?php echo $_rs['upload_auto'] ? 'true' : 'false';?>,
		'sendAsBinary':<?php echo $_rs['_upload_binary'] ? 'true' : 'false';?>,
		'accept':{'title':'<?php echo $_rs['upload_type']['title'];?>(<?php echo $_rs['upload_type']['swfupload'];?>)','extensions':'<?php echo $_rs['upload_type']['ext'];?>'},
		'fileSingleSizeLimit':'<?php echo $_rs['upload_type']['maxsize']*100;?>'
	});
	obj_<?php echo $_rs['identifier'];?>.showhtml();
	$("#select_res_<?php echo $_rs['identifier'];?>").click(function(){
		var url = "<?php echo phpok_url(array('ctrl'=>'open','func'=>'upload','id'=>$_rs['identifier'],'multiple'=>$_rs['is_multiple'],'cate_id'=>$_rs['upload_type']['id']));?>";
		var t = "<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>";
		var old = $("#<?php echo $_rs['identifier'];?>").val();
		if(t == 'true'){
			if(old){
				$.dialog.data('select-<?php echo $_rs['identifier'];?>',old);
			}
			$.dialog.open(url,{
				title: "资源管理器",
				lock : true,
				width: "645px",
				height: "450px",
				ok: function(){
					var val = $.dialog.data('select-<?php echo $_rs['identifier'];?>');
					if(val){
						$("#<?php echo $_rs['identifier'];?>").val(val);
					}else{
						$("#<?php echo $_rs['identifier'];?>").val('');
					}
					$.dialog.data('select-<?php echo $_rs['identifier'];?>','');
					obj_<?php echo $_rs['identifier'];?>.showhtml();
				},
				cancel:function(){},
				'cancelVal':'取消'
			});
		}else{
			if(old){
				url += "&selected="+old;
			}
			$.dialog.open(url,{
				title: "资源管理器",
				lock : true,
				width: "645px",
				height: "450px"
			});
		}
	});
});
</script>

