<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","修改头像"); ?><?php $this->output("head","file"); ?>
<link rel="stylesheet" type="text/css" href="js/webuploader/webuploader.css" />
<link href="tpl/www/css/imgareaselect/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/webuploader/webuploader.min.js"></script>
<script type="text/javascript" src="tpl/www/js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript">
//附件上传后执行的JS动作
function update_avatar(rs)
{
	if(!rs || rs.status != 'ok'){
		alert(rs.content);
		return false;
	}
	//$("#avatar").val(rs.content.filename);
	//$("#avatar_view").attr('src',rs.content.filename);
	//更新头像ID
	$.ajax({
		'url': api_url('usercp','avatar','data='+$.str.encode(rs.content.filename)),
		'dataType': 'json',
		'success': function(rs) {
			return true;
		}
	});
}
function preview(img, selection)
{
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
}
function preview2(img, selection)
{
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
}
function ready_cut(width,height)
{
	$('#thumbnail').imgAreaSelect({
		"aspectRatio"	: '1:1',
		"minWidth"		: "150",
		"minHeight"		: "150",
		"x1"			: "0",
		"y1"			: "0",
		"x2"			: "150",
		"y2"			: "150",
		"onSelectChange": preview,
		"imageWidth"	: width,
		"imageHeight"	: height,
		"handles"		: true
	});
}
function save_thumb()
{
	var x1 = $('#x1').val();
	var y1 = $('#y1').val();
	var x2 = $('#x2').val();
	var y2 = $('#y2').val();
	var w = $('#w').val();
	var h = $('#h').val();
	var thumb_id = $("#thumb_id").val();
	if(!thumb_id){
		alert('未上传图片');
		return false;
	}
	if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
		alert("未设置裁剪框！");
		return false;
	}else{
		var url = get_url('usercp','avatar_cut');
		url += "&thumb_id="+thumb_id;
		url += "&x1="+x1;
		url += "&y1="+y1;
		url += "&x2="+x2;
		url += "&y2="+y2;
		url += "&x1="+x1;
		url += "&w="+w;
		url += "&h="+h;
		//存储并更新图片
		var rs = $.phpok.json(url);
		if(rs.status == "ok"){
			alert('头像更新成功');
			window.location.reload();
			return true;
		}else{
			alert(rs.content);
		}
	}
}
</script>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>当前头像</h3>
			<div class="table" style="padding:10px;">
				<img src="<?php echo $rs['avatar'] ? $rs['avatar'] : 'tpl/www/images/avatar_huge.gif';?>" width="150px" border="0" />
			</div>
		</div>
		<div class="pfw mbottom10">
			<h3>修改头像</h3>
			<div class="table">
				<table width="100%">
				<tr>
					<td style="padding:10px;">
						<div id="uploader" class="wu-example">
							<!--用来存放文件信息-->
							<div id="thelist" class="uploader-list"></div>
							<div class="btns">
								<div id="btn_picture"></div>
							</div>
						</div>
					</td>
				</tr>
				</table>
				<div style="display:none;" id="show_cut">
					<div><img src="about:blank" width="500" alt="原图" id="thumbnail" /></div>
					<div style="padding:10px"><input type="button" onclick="save_thumb()" value=" 保存图片 " /></div>
				</div>
				<input type="hidden" name="thumb_id" value="" id="thumb_id" />
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var uploader = WebUploader.create({
		auto: true,
		swf: webroot + 'js/webuploader/uploader.swf',
		// 文件接收服务端。
		server: api_url('upload','save'),
		compress: false,
		pick: '#btn_picture',
		fileVal: 'upfile',
		formdata:{
			'<?php echo session_name();?>':'<?php echo session_id();?>'
		},
		accept: {
			title: '图片',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		},
		resize: false
	});
	uploader.on('uploadSuccess',function(file,data){
		if(data.status == 'ok'){
			var info = data.content;
			var width = (info.attr.width && info.attr.width) > 500 ? 500 : info.attr.width;
			var height = parseInt((width * info.attr.height)/info.attr.width);
			$("#show_cut").show();
			$("#thumbnail").attr('src',info.filename).css('width',width+"px").css('height',height+"px");
			$("#thumb_id").val(info.id);
			ready_cut(width,height);
		}else{
			alert(data.content);
			$("#show_cut").hide();
		}
	});
});
</script>
<?php $this->output("foot","file"); ?>