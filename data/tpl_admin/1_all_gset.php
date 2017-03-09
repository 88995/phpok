<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('all.js');?>"></script>
<div class="tips">
	您当前的位置：
	<a href="<?php echo admin_url('all');?>">全局维护</a>
	<?php if($id){ ?>
	&raquo; 编辑全局参数
	<?php } else { ?>
	&raquo; 添加全局
	<?php } ?>
</div>
<form method="post" action="<?php echo admin_url('all','gset_save');?>" onsubmit="return g_ext_check();">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
<div class="table">
	<div class="title">
		名称：
		<span class="note">用于后台阅读，尽量简短，建议不超过5个汉字</span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="title" name="title" class="default" value="<?php echo $rs['title'];?>" /></td>
			<td><div id="title_note"></div></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		标识：
		<span class="note">限<span class="red">字母、数字、下划线或中划线，且必须是字母开头</span></span>
	</div>
	<div class="content"><input type="text" id="identifier" name="identifier" class="default" value="<?php echo $rs['identifier'];?>" /></div>
</div>

<div class="table">
	<div class="title">
		图标：
	</div>
	<div class="content">
		<ul class="layout">
			<?php $icolist_id["num"] = 0;$icolist=is_array($icolist) ? $icolist : array();$icolist_id["total"] = count($icolist);$icolist_id["index"] = -1;foreach($icolist AS $key=>$value){ $icolist_id["num"]++;$icolist_id["index"]++; ?>
			<li><label title="<?php echo basename($value);?>">
				<table>
				<tr>
					<td><input type="radio" name="ico" value="<?php echo $value;?>"<?php if($rs['ico'] == $value){ ?> checked<?php } ?> /></td>
					<td><img src="<?php echo $value;?>" alt="<?php echo basename($value);?>" /></td>
				</tr>
				</table>
			</label></li>
			<?php } ?>
			<div class="clear"></div>
		</ul>
	</div>
</div>

<div class="table">
	<div class="title">
		状态：
		<span class="note">是否在前台网页启用</span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><label for="status_0"><input type="radio" name="status" id="status_0" value="0"<?php if($id && !$rs['status']){ ?> checked<?php } ?> />不启用</label></td>
			<td><label for="status_1"><input type="radio" name="status" id="status_1" value="1"<?php if(!$id || $rs['status']){ ?> checked<?php } ?> />启用</label></td>
		</tr>
		</table>
	</div>
</div>

<div class="table">
	<div class="content">
		<br />
		<input type="submit" value="提 交" class="submit" />
		&nbsp; &nbsp;
		<?php if($id && !$rs['is_system']){ ?>
		<input type="button" value="删 除" class="btn" onclick="ext_g_delete(<?php echo $id;?>)"/>
		<?php } ?>
		<br />
	</div>
</div>
</form>
<?php $this->output("foot","file"); ?>