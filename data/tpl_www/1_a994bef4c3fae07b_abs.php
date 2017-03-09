<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><link rel="stylesheet" type="text/css" href="js/webuploader/webuploader.css" />
<script type="text/javascript" src="js/webuploader/webuploader.min.js"></script>
<script type="text/javascript" src="js/webuploader/www.upload.js"></script>
<input type="hidden" name="<?php echo $_rs['identifier'];?>" id="<?php echo $_rs['identifier'];?>" value="<?php echo $_rs['content'];?>" />
<input type="hidden" id="<?php echo $_rs['identifier'];?>_status" value="" />
<style type="text/css">
.<?php echo $_rs['identifier'];?>_thumb{float:left;width:144px;margin:3px 5px;padding:1px;border:1px solid #ccc;border-radius:3px;position:relative;}
.<?php echo $_rs['identifier'];?>_thumb img{padding:2px;}
.<?php echo $_rs['identifier'];?>_thumb .sort{position:absolute;right:5px;top:5px;}
.<?php echo $_rs['identifier'];?>_thumb .sort input.taxis{width:40px;border:1px solid #ccc;border-radius:3px;height:22px;text-align:center;padding:3px;}
.phpok-btn{
	position:relative;
	overflow:visible;
	display:inline-block;
	padding:0.2em 0.6em;
	border:1px solid #d4d4d4;
	margin:0;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0 #fff;
	font:14px/normal "Microsoft Yahei","宋体","Arial",sans-serif;
	color:#333;
	white-space:nowrap;
	cursor:pointer;
	outline:none;
	background-color:#ececec;
	background-image:-webkit-gradient(linear,0 0,0 100%,from(#f4f4f4),to(#ececec));
	background-image:-moz-linear-gradient(#f4f4f4,#ececec);
	background-image:-ms-linear-gradient(#f4f4f4,#ececec);
	background-image:-o-linear-gradient(#f4f4f4,#ececec);
	background-image:linear-gradient(#f4f4f4,#ececec);
	-moz-background-clip:padding;
	background-clip:padding-box;
	border-radius:3px;
	zoom:1;
	*display:inline
}

.phpok-btn:hover,
.phpok-btn:focus,
.phpok-btn:active,
.phpok-btn.active {
	border-color: #3072b3;
	border-bottom-color: #2a65a0;
	text-decoration: none;
	text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
	color: #fff;
	background-color: #3c8dde;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#599bdc), to(#3072b3));
	background-image: -moz-linear-gradient(#599bdc, #3072b3);
	background-image: -o-linear-gradient(#599bdc, #3072b3);
	background-image: linear-gradient(#599bdc, #3072b3);
}

.phpok-btn:active,
.phpok-btn.active {
	border-color: #2a65a0;
	border-bottom-color: #3884cd;
	background-color: #3072b3;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3072b3), to(#599bdc));
	background-image: -moz-linear-gradient(#3072b3, #599bdc);
	background-image: -ms-linear-gradient(#3072b3, #599bdc);
	background-image: -o-linear-gradient(#3072b3, #599bdc);
	background-image: linear-gradient(#3072b3, #599bdc);
}

.phpok-btn::-moz-focus-inner {padding: 0;border: 0;}

.button-group {
    display: inline-block;
    list-style: none;
    padding: 0;
    margin: 0;
    /* IE hacks */
    zoom: 1;
    *display: inline;
}

.phpok-btn + .phpok-btn,
.phpok-btn + .button-group,
.button-group + .phpok-btn,
.button-group + .button-group {
    margin-left: 15px;
}

.button-group li {
    float: left;
    padding: 0;
    margin: 0;
}

.button-group .phpok-btn {
    float: left;
    margin-left: -1px;
}

.button-group > .phpok-btn:not(:first-child):not(:last-child),
.button-group li:not(:first-child):not(:last-child) .phpok-btn {
    border-radius: 0;
}

.button-group > .phpok-btn:first-child,
.button-group li:first-child .phpok-btn {
    margin-left: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.button-group > .phpok-btn:last-child,
.button-group li:last-child > .phpok-btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
button.button_<?php echo $_rs['identifier'];?>{
	height: 23px;
	padding: 0 5px;
	margin: 0;
	border: 1px solid #ACACAC;
	line-height: 19px;
	text-align: center;
	cursor:pointer;
	font-family:"Microsoft Yahei";
}
button.button_<?php echo $_rs['identifier'];?>:hover {
	border-color: #7EB4EA;
	background: #E3F0FC;
}

</style>
<div class="_e_upload">
	<div class="_select">
		<table>
		<tr>
			<td><div id="<?php echo $_rs['identifier'];?>_picker"></div></td>
			<?php if(!$_rs['upload_auto']){ ?>
			<td valign="top" style="padding-left:2px;"><button id="<?php echo $_rs['identifier'];?>_submit" type="button" class="button_<?php echo $_rs['identifier'];?>"><?php echo P_Lang("开始上传");?></button></td>
			<?php } ?>
			<?php if($session['user_id']){ ?>
			<td valign="top" style="padding-left:2px;"><button id="select_res_<?php echo $_rs['identifier'];?>" type="button" class="button_<?php echo $_rs['identifier'];?>"><?php echo P_Lang("选择");?><?php echo $_rs['upload_type']['title'];?></button></td>
			<?php } ?>
			<?php if(!$app->is_mobile()){ ?>
			<td><div class="gray i" style="line-height:180%;">&nbsp;<?php echo P_Lang("支持格式有：");?><?php echo $_rs['upload_type']['swfupload'];?></div></td>
			<?php } ?>
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
	obj_<?php echo $_rs['identifier'];?> = new $.www_upload({
		'id':'<?php echo $_rs['identifier'];?>',
		'swf':'js/webuploader/uploader.swf',
		'server':'<?php echo phpok_url(array('ctrl'=>'upload','func'=>'save','cateid'=>$_rs['cate_id']));?>',
		'pick':{'id':'#<?php echo $_rs['identifier'];?>_picker','multiple':<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>},
		'resize':false,
		'multiple':"<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>",
		"formData":{'<?php echo session_name();?>':'<?php echo session_id();?>'},
		'fileVal':'upfile',
		'disableGlobalDnd':true,
		'compress':false,
		'sendAsBinary':false,
		'auto':<?php echo $_rs['upload_auto'] ? 'true' : 'false';?>,
		'accept':{'title':'<?php echo $_rs['upload_type']['title'];?>(<?php echo $_rs['upload_type']['swfupload'];?>)','extensions':'<?php echo $_rs['upload_type']['ext'];?>'},
		'fileSingleSizeLimit':'<?php echo $_rs['upload_type']['maxsize'];?>'
	});
	obj_<?php echo $_rs['identifier'];?>.showhtml();
});
</script>
<?php if($session['user_id']){ ?>
<script type="text/javascript">
$(document).ready(function(){
		$("#select_res_<?php echo $_rs['identifier'];?>").click(function(){
		var url = "<?php echo phpok_url(array('ctrl'=>'open','id'=>$_rs['identifier'],'multiple'=>$_rs['is_multiple'],'cate_id'=>$_rs['upload_type']['id']));?>";
		url = $.phpok.nocache(url);
		var t = "<?php echo $_rs['is_multiple'] ? 'true' : 'false';?>";
		var old = $("#<?php echo $_rs['identifier'];?>").val();
		if(t == 'true'){
			if(old){
				$.cookie.set('phpok_input_<?php echo $_rs['identifier'];?>',old);
			}
			$.dialog.open(url,{
				title: "资源管理器",
				lock : true,
				width: "645px",
				height: "450px",
				ok: function(){
					return true;
				}
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
<?php } ?>
