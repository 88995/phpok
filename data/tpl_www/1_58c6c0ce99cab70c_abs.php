<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><style type="text/css">
ul.radio_<?php echo $_rs['identifier'];?>{list-style:none;margin:0;padding:0;line-height:16px;}
ul.radio_<?php echo $_rs['identifier'];?> label{vertical-align:middle;display:inline-block;}
ul.radio_<?php echo $_rs['identifier'];?> input{margin:-3px 5px 0 0;padding:0;border:0;vertical-align:middle;}
</style>
<?php if($_rs['put_order']){ ?>
<style type="text/css">
ul.radio_<?php echo $_rs['identifier'];?> li{display:block;}
</style>
<?php } else { ?>
<style type="text/css">
ul.radio_<?php echo $_rs['identifier'];?>:after{content:'&nbsp;';display: block;visibility:hidden;height:0;line-height:0;clear:both;overflow:hidden;}
ul.radio_<?php echo $_rs['identifier'];?> li{float:left;margin-right:5px;}
</style>
<?php } ?>
<ul class="radio_<?php echo $_rs['identifier'];?>">
	<?php $_rslist_id["num"] = 0;$_rslist=is_array($_rslist) ? $_rslist : array();$_rslist_id["total"] = count($_rslist);$_rslist_id["index"] = -1;foreach($_rslist AS $key=>$value){ $_rslist_id["num"]++;$_rslist_id["index"]++; ?>
	<li><label><input type="radio" name="<?php echo $_rs['identifier'];?>" value="<?php echo $value['val'];?>"<?php if($_rs['content'] == $value['val']){ ?> checked<?php } ?> /><?php echo $value['title'];?></label></li>
	<?php } ?>
	<?php if($_rs['note']){ ?>
	<li style="line-height:24px;color:gray;font-style:italic;margin-left:-3px;"><?php echo $_rs['note'];?></li>
	<?php } ?>
</ul>