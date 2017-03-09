<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<div style="margin-bottom:5px;">
<table cellpadding="5" cellspacing="1" style="border:1px solid #ccc;">
<tr>
	<th height="30px" colspan="6" class="lft" style="background:#eee;border-bottom:1px solid #ccc;">
		<?php echo $options[$key]['title'];?>
		<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="biz_attr_edit('<?php echo $key;?>','<?php echo $tid;?>')" class="phpok-btn" />
		<input type="button" value="<?php echo P_Lang("删除");?>" onclick="biz_attr_delete('<?php echo $key;?>','<?php echo $tid;?>')" class="phpok-btn" />
	</th>
</tr>
<tr>
	<th style="background:#FFF;height:26px;">属性名称</th>
	<th width="110px" style="background:#FFF;">加/减价格</th>
	<?php if($freight['type'] == 'weight'){ ?><th width="110px" style="background:#FFF;">加/减重量</th><?php } ?>
	<?php if($freight['type'] == 'volume'){ ?><th width="110px" style="background:#FFF;">加/减体积</th><?php } ?>
	<th width="60px" style="background:#FFF;">排序</th>
</tr>
	<?php $tmpid["num"] = 0;$value=is_array($value) ? $value : array();$tmpid["total"] = count($value);$tmpid["index"] = -1;foreach($value AS $k=>$v){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<tr>
		<td style="background:#FFF;"><?php echo $v['title'];?><?php if($v['val']){ ?>/<?php } ?><?php echo $v['val'];?></td>
		<td align="center" style="background:#FFF;"><?php echo $v['price'];?></td>
		<?php if($freight['type'] == 'weight'){ ?><td align="center" style="background:#FFF;"><?php echo $v['weight'];?></td><?php } ?>
		<?php if($freight['type'] == 'volume'){ ?><td align="center" style="background:#FFF;"><?php echo $v['volume'];?></td><?php } ?>
		<td align="center" style="background:#FFF;"><?php echo $v['taxis'];?></td>
	</tr>
	<?php } ?>
</table>
</div>
<?php } ?>
