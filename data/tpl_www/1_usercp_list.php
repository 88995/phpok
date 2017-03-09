<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title = $page_rs['title'].' - 会员中心';?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle","会员中心"); ?><?php $this->output("head","file"); ?>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3><?php echo $page_rs['title'];?><a href="<?php echo phpok_url(array('ctrl'=>'post','id'=>$id));?>" class="more">添加</a></h3>
			<div class="table_lc" style="margin:5px 5px 0 5px;">
			<table width="100%">
			<tr>
				<th>ID</th>
				<th class="lft"><?php echo $page_rs['alias_title'] ? $page_rs['alias_title'] : '主题';?></th>
				<th width="50px">状态</th>
				<th width="77px">操作</th>
			</tr>
			<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<tr>
				<td align="center"><?php echo $value['id'];?></td>
				<td>
					<a href="<?php echo $value['url'];?>" target="_blank"><?php echo $value['title'];?></a><br />
					<span class="gray">发布时间：<?php echo time_format($value['dateline']);?>，查看次数：<?php echo $value['hits'];?></span>
				</td>
				<td align="center"><?php if($value['status']){ ?>正常<?php } else { ?><span class="red">审核中</span><?php } ?></td>
				<td align="center"><input type="button" value="编辑" class="button blue" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'post','func'=>'edit','id'=>$value['id']));?>')" /></td>
			</tr>
			<?php } ?>
			</table>
			</div>
			<?php $this->output("block_pagelist","file"); ?>
		</div>
	</div>
	<div class='clear'></div>
</div>


<?php $this->output("foot","file"); ?>