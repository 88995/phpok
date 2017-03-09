<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","在线充值"); ?><?php $this->output("head","file"); ?>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<form method="post" action="<?php echo phpok_url(array('ctrl'=>'payment','func'=>'create','type'=>'recharge'));?>" onsubmit="return checksubmit()">
		<div class="pfw mt10">
			<h3>您的操作：</h3>
			<div class="payment">
				<li>
					您将给：
					<select name="wealth" style="padding:3px;">
						<?php if($id && $rs){ ?>
						<option value="<?php echo $rs['id'];?>"><?php echo $rs['title'];?> / 充值比：1元 = <?php echo $rs['pay_ratio'];?><?php echo $rs['unit'];?></option>
						<?php } else { ?>
						<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist AS $k=>$v){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<option value="<?php echo $v['id'];?>"><?php echo $v['title'];?> / 充值比：1元 = <?php echo $v['pay_ratio'];?><?php echo $v['unit'];?></option>
						<?php } ?>
						<?php } ?>
					</select>
					充值：<input type="text" name="price" id="price" value="<?php echo $price;?>" /> 元
				</li>
			</div>
		</div>



		<?php $paylist_id["num"] = 0;$paylist=is_array($paylist) ? $paylist : array();$paylist_id["total"] = count($paylist);$paylist_id["index"] = -1;foreach($paylist AS $key=>$value){ $paylist_id["num"]++;$paylist_id["index"]++; ?>
		<?php if($value['paylist']){ ?>
		<div class="pfw mt10">
			<h3><?php echo $value['title'];?></h3>
			<div class="payment">
				<ul>
					<?php $value_paylist_id["num"] = 0;$value['paylist']=is_array($value['paylist']) ? $value['paylist'] : array();$value_paylist_id["total"] = count($value['paylist']);$value_paylist_id["index"] = -1;foreach($value['paylist'] AS $k=>$v){ $value_paylist_id["num"]++;$value_paylist_id["index"]++; ?>
					<li><label><input name="payment" type="radio" value="<?php echo $v['id'];?>"<?php if($v['id'] == $config['biz_payment']){ ?> checked<?php } ?> /><?php echo $v['title'];?></label></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<?php } ?>

		<div class="paymenbtn mt10">
			<table width="100%">
			<tr>
				<td><input type="submit" value="" class="paybtn" /></td>
			</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="clear"></div>
</div>
<?php $this->output("foot","file"); ?>