<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php echo tpl_head(array('css'=>"tips.css",'title'=>"友情提示"));?>
<?php if(!$url){ ?>
<style type="text/css">
.body .tips .txt{margin-left:70px;padding-top:10px;line-height:50px;font-weight:bold;}
</style>
<?php } ?>
<body>
<div class="body">
	<div class="tips <?php echo $type;?>">
		<?php if($url){ ?>
		<div class="title"><?php echo $tips;?></div>
		<div class="note"><a href="<?php echo $url;?>">系统将在 <span class="red"><?php echo $time;?>秒</span> 后跳转，手动跳转请点这里</a></div>
		<?php } else { ?>
		<div class="txt"><?php echo $tips;?></div>
		<?php } ?>
	</div>
</div>
<?php if($url){ ?>
	<script type="text/javascript">
	var url = "<?php echo $url;?>";
	var mtime = <?php echo $time;?> * 1000;
	function refresh()
	{
		url = url.replace(/&amp;/g,"&");
		window.location.href = url;
	}
	window.setTimeout("refresh()",mtime);
	</script>
<?php } ?>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>
