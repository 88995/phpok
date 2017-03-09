<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","订单中心"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".o-dark").mouseover(function(){
		$(this).addClass('o-dark-over');
	}).mouseout(function(){
		$(this).removeClass('o-dark-over');
	});
	$(".o-white").mouseover(function(){
		$(this).addClass('o-white-over');
	}).mouseout(function(){
		$(this).removeClass('o-white-over');
	});
});
</script>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>订单中心</h3>
			<div class="list">
			<table class="list" width="100%">
			<tr>
				<th width="80px">下单时间</th>
				<th width="150px">订单编号</th>
				<th width="80">数量</th>
				<th class="o-price">金额</th>
				<th class="o-status">审核</th>
				<th width="140">明细</th>
			</tr>
			<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
			<tr<?php if($rslist_id['num']%2 == ''){ ?> class="o-dark"<?php } else { ?> class="o-white"<?php } ?>>
				<td class="center" height="30"><?php echo date('Y.m.d',$value['addtime']);?></td>
				<td class="center"><?php echo $value['sn'];?></td>
				<td class="center"><?php echo $value['qty'];?></td>
				<td class="center"><?php echo price_format($value['price'],$value['currency_id'],$value['currency_id']);?></td>
				<td class="center"><?php echo $value['status_info'];?></td>
				<td align="center">
					<input type="button" value=" 查看 " onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'order','func'=>'info','id'=>$value['id']));?>',false)" />
					<input type="button" value=" 评论 " onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'order','func'=>'comment','id'=>$value['id']));?>',false)" />
				</td>
			</tr>
			<?php } ?>
			</table>
			</div>
			<div style="padding:0 3px"><?php $this->output("block_pagelist","file"); ?></div>
		</div>
		<div class="pfw mbottom10">
			<h3>说明</h3>
			<ul style="margin:0;padding:10px 10px 10px 40px;">
				<li>如需要改单，请联系我们的管理员</li>
				<!--li>本站订单系统还不够强大的，如果您需要更加强大的功能，请联系官网进行定制</li-->
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php $this->output("foot","file"); ?>