<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $contactus = phpok('contactus');?>
<style type="text/css">
.b_contact h4{line-height:200%;margin:0;padding:0 0 0 5px;font-size:1.1em;font-weight:500;}
.b_contact ul{list-style:none;margin:0;padding:0;}
.b_contact ul li{line-height:170%;position:relative;padding-left:70px;min-height:30px;margin-right:5px;}
.b_contact ul li b{font-weight:bold;position:absolute;left:0;width:70px;text-align:right;}
</style>
<div class="pfw mb10">
	<h3><?php echo $contactus['title'];?><?php if($showmore){ ?><a href="<?php echo $contactus['url'];?>" class="more">更多</a><?php } ?></h3>
	<div class="b_contact">
		<h4><?php echo $contactus['company'];?></h4>
		<ul>
			<li><b>地址：</b><?php echo $contactus['address'];?></li>
			<li><b>Email：</b><?php echo $contactus['email'];?></li>
			<li><b>邮编：</b><?php echo $contactus['zipcode'];?></li>
			<li><b>电话：</b><?php echo $contactus['tel'];?></li>
			<li><b>联系人：</b><?php echo $contactus['fullname'];?></li>
		</ul>
	</div>
</div>