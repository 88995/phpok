<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","会员财富"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
function payit(id,title)
{
	$.dialog.prompt('请输入要充值的金额（仅支持整数，最小充值1元）：',function(val){
		if(val < 1){
			$.dialog.alert('充值金额不能少于1元');
			return false;
		}
		var url = get_url('payment','index','id='+id+"&price="+$.str.encode(val));
		$.phpok.go(url);
	},10).title('在线充值');
}
</script>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>财富档案</h3>
			<div class="table_lc" style="margin:5px;">
			<table width="100%">
			<tr>
				<th class="lft">名称</th>
				<th width="77px">操作</th>
			</tr>
			<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<tr>
				<td>
					<div><b><?php echo $value['title'];?></b>，您当前有 <span class="red"><?php echo $value['val'];?></span> <?php echo $value['unit'];?></div>
					<?php if($value['ifpay']){ ?>
					<div class="gray">充值比例：1元人民币 = <?php echo $value['pay_ratio'];?> <?php echo $value['unit'];?></div>
					<?php } ?>
					<?php if($value['ifcash'] && !$value['ifpay']){ ?>
					<div class="gray">抵现比例：100<?php echo $value['unit'];?> = <?php echo $value['cash_ratio'];?>元人民币，可用于抵扣购物金额</div>
					<?php } ?>
				</td>
				<td align="center">
				<?php if($value['ifpay']){ ?><input type="button" value="充值" class="button blue" onclick="payit('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" /><?php } ?>
				</td>
			</tr>
			<?php } ?>
			</table>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php $this->output("foot","file"); ?>