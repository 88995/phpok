<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><script id="<?php echo $_rs['identifier'];?>" type="text/plain" style="<?php echo $_rs['form_style'];?>"><?php echo $_rs['content'];?></script>
<?php if($_rs['etype'] == 'simple'){ ?>
<script type="text/javascript">
var toolbars_<?php echo $_rs['id'];?> = [[
	'source','|', 
	'bold', 'italic', 'underline', 'strikethrough', '|',
	'justifyleft', 'justifycenter', 'justifyright', '|',
	'removeformat', 'blockquote', 'pasteplain', '|',
	'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|',
	'link', 'unlink','|',
	<?php if($_rs['btn_map']){ ?>'map',<?php } ?>
	<?php if($_rs['btn_image']){ ?>'insertimage',<?php } ?>
	<?php if($_rs['btn_video']){ ?>'insertvideo',<?php } ?>
	<?php if($_rs['btn_file']){ ?>'attachment',<?php } ?>
	<?php if($_rs['btn_info']){ ?>'phpokinfo',<?php } ?>
	<?php if($_rs['btn_image'] || $_rs['btn_video'] || $_rs['btn_file'] || $_rs['btn_info']){ ?>'|',<?php } ?>
	'help'
]];
</script>
<?php } else { ?>
<script type="text/javascript">
var toolbars_<?php echo $_rs['id'];?> = [[
	'fullscreen','source', '|',
	'bold', 'italic', 'underline', 'strikethrough','|',
	'justifyleft', 'justifycenter', 'justifyright', '|',
	'insertorderedlist', 'insertunorderedlist','forecolor', 'backcolor',  '|',
	'indent', 'horizontal','blockquote','inserttable','|',
	'link', 'unlink', 'anchor',
	<?php if($_rs['btn_image']){ ?>'|','insertimage',<?php } ?>
	'help'
],[
	'fontfamily','fontsize','paragraph','insertcode',
	<?php if($_rs['btn_map']){ ?>'map',<?php } ?>
	<?php if($_rs['btn_page']){ ?>'pagebreak',<?php } ?>
	<?php if($_rs['btn_tpl']){ ?>'template',<?php } ?>
	'|',
	<?php if($_rs['btn_video']){ ?>'insertvideo',<?php } ?>
	<?php if($_rs['btn_file']){ ?>'attachment',<?php } ?>
	<?php if($_rs['btn_info']){ ?>'phpokinfo',<?php } ?>
	<?php if($_rs['btn_video'] || $_rs['btn_file'] || $_rs['btn_info']){ ?>'|',<?php } ?>
	'superscript', 'subscript','|',
	'preview','spechars','removeformat', 'pasteplain'
]];
</script>
<?php } ?>
<script type="text/javascript">
var edit_config_<?php echo $_rs['id'];?> = {
	 'UEDITOR_HOME_URL':webroot+'js/ueditor/'
	,'serverUrl':get_url('ueditor')
	,'toolbars':toolbars_<?php echo $_rs['id'];?>
	<?php if($_rs['btn_info']){ ?>,'labelMap':{'phpokinfo':'主题库'}<?php } ?>
    ,'initialFrameWidth':'<?php echo $_rs['width'];?>'
    ,'allowDivTransToP': false
    ,'initialFrameHeight':'<?php echo $_rs['height'];?>'
	,'sourceEditorFirst':<?php echo $_rs['is_code'] ? 'true' :'false';?>
	,'readonly':<?php echo $_rs['is_read'] ? 'true' :'false';?>
	,'pasteplain':<?php echo $_rs['paste_text'] ? 'true' : 'false';?>
	,'autoFloatEnabled':false
	,'autoHeightEnabled':false
	<?php if($_rs['btn_page']){ ?>,'pageBreakTag':'[:page:]'<?php } ?>
	,'textarea':'<?php echo $_rs['identifier'];?>'
	<?php if($_rs['btn_info']){ ?>,'iframeUrlMap':{'phpokinfo':get_url('ueditor','info')}<?php } ?>
};
var edit_<?php echo $_rs['id'];?> = UE.getEditor('<?php echo $_rs['identifier'];?>',edit_config_<?php echo $_rs['id'];?>);
</script>
