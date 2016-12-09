<?php 
if(isset($flag_applied_lowest_price) == 1){
$data['applied_lowest_price'] = "";
}
if(isset($flag_reward_from_data) == 1){
$data['reward_from_data'] = "";
}
if(isset($flag_reward_to_data) == 1){
$data['reward_to_data'] = "";
}
if(isset($flag_reward_from_time) == 1){
$data['reward_from_time'] = "";
}
if(isset($flag_reward_to_time) == 1){
$data['reward_to_time'] = "";
}
if($data['reward_to_time'] == "00:00"){
$data['reward_to_time'] = "";
}
if($data['reward_to_data'] == "0000-00-00"){
$data['reward_to_data'] = "";
}
if(isset($flag_discount_price) == 1){
$data['discount_price'] = "";
}
if(isset($flag_reward_point) == 1){
$data['reward_point'] = "";
}
if(isset($flag_reward_content) == 1){
$data['reward_content'] = "";
}
?>
<?php 
$reward_from_data = set_value('reward_from_data') == false ? $data['reward_from_data'] : set_value('reward_from_data');
$reward_to_data = set_value('reward_to_data') == false ? $data['reward_to_data'] : set_value('reward_to_data');
$reward_from_time = set_value('reward_from_time') == false ? $data['reward_from_time'] : set_value('reward_from_time');
$reward_to_time = set_value('reward_to_time') == false ? $data['reward_to_time'] : set_value('reward_to_time');
$applied_lowest_price = set_value('applied_lowest_price') == false  ? $data['applied_lowest_price'] : set_value('applied_lowest_price');
$discount_price = set_value('discount_price') == false ? $data['discount_price'] : set_value('discount_price');
$reward_point  = set_value('reward_point') == false ? $data['reward_point'] : set_value('reward_point');
$reward_content  = set_value('reward_content') == false ? $data['reward_content'] : set_value('reward_content');

// Check active flag
$active_flg = isset($data['active_flag']) ? $data['active_flag'] : 0;
?>

<div id="contents">
<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
		
		<?php $this->view('frontend/layout/_company_menu'); ?>
	
		</header>
	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form id = "editForm1" action="<?php echo base_url('company/support'); ?>" method="post">
				<input type="hidden" name="active_flag" id="active_flag" value="<?php echo $active_flg; ?>">
				<input type="hidden" name="form_has_data" value='0' id="form_has_data"> 
				<h2 class="kigyou">応援条件</h2>
				 <table class="form edit">
				 <tbody>
					 <tr>
					 	<input type="hidden" name="company_reward_id" value="<?php echo $data['company_reward_id'];?>"/>
						<th class="h3 top" colspan="2"><h3>応援条件</h3></th>
					 </tr>
					 <tr>
						<th>応援区分<span class="must">※</span></th>
						<td>
						<?php
								$class_error_reward_group = !empty(form_error('reward_group')) ? "error" : "";
						?>
							<div class="select_box">
						<select name="reward_group" class="<?=$class_error_reward_group; ?>">
								<option value="1" <?php echo set_select('reward_group',1, ( !empty($data['reward_group']) && $data['reward_group'] == "1" ? TRUE : FALSE )); ?>>通常応援</option>
								<option value="2" <?php echo set_select('reward_group',2, ( !empty($data['reward_group']) && $data['reward_group'] == "2" ? TRUE : FALSE )); ?>>応援不要企業寄付</option>
								<option value="3" <?php echo set_select('reward_group',3, ( !empty($data['reward_group']) && $data['reward_group'] == "3" ? TRUE : FALSE )); ?>>寄付</option>
 						</select>
 						<span style="color:red" class="php-error"><?php echo form_error('reward_group'); ?></span>
						<div class="error-js"></div>
							</div>
						</td>
					 </tr>
					 <tr>
						<th>応援対象年月日<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_data = !empty(form_error('reward_from_data')) ? "error" : "";
							?>
							<input type="date" id="fromDate" name="reward_from_data" value="<?php echo $reward_from_data; ?>" placeholder="" class="<?=$class_error_reward_from_data; ?>">
						<span style="color:red" class="php-error"><?php echo form_error('reward_from_data'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					  <tr>
						<th>応援対象年月日<br>To</th>
						<td>
							<?php
								$class_error_reward_to_data = !empty(form_error('reward_to_data')) ? "error" : "";
							?>
							<input type="date" id="toDate" name="reward_to_data" value="<?php echo $reward_to_data; ?>" placeholder="" class="<?=$class_error_reward_to_data; ?>">
						<span style="color:red" class="php-error"><?php echo form_error('reward_to_data'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>応援対象時間<br>From<span class="must">※</span></th>
						<td>
						<?php
								$class_error_reward_from_time = !empty(form_error('reward_from_time')) ? "error" : "";
							?>	
							<input type="time" id="fromTime" name="reward_from_time" value="<?php echo $reward_from_time; ?>" placeholder="" class="<?=$class_error_reward_from_time; ?>">
						<span style="color:red" class="php-error"><?php echo form_error('reward_from_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>応援対象時間<br>To</th>
						<td>
						<?php
								$class_error_reward_to_time = !empty(form_error('reward_to_time')) ? "error" : "";
							?>	
							
							<input type="time" id="toTime" name="reward_to_time" value="<?php echo $reward_to_time; ?>" placeholder="" class="<?=$class_error_reward_to_time; ?>">
						<span style="color:red" class="php-error"><?php echo form_error('reward_to_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					  <tr>
					 	<th>応援適用最低金額<span class="must">※</span></th>
						<td>
						<?php
							$class_error_applied_lowest_price = !empty(form_error('applied_lowest_price')) ? "error" : "";
						?>	
						<input type="tel" name="applied_lowest_price" value="<?php echo $applied_lowest_price; ?>" placeholder="" class="w150 <?=$class_error_applied_lowest_price; ?>"> 円
						<span style="color:red" class="php-error"><?php echo form_error('applied_lowest_price'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>購入者割引<span class="must">※</span></th>
						<td>
						<?php
							$class_error_discount_price = !empty(form_error('discount_price')) ? "error" : "";
							$class_error_discount_rate = !empty(form_error('discount_rate')) ? "error" : "";
						?>	
						<input type="tel" id ="discount_price" name="discount_price" value="<?php if($discount_price == 0){echo '';}else{echo $discount_price;} ?>" placeholder="" class="w50 <?=$class_error_discount_price; ?>">
						円　or
						<div class="select_box w65">
						<select name="discount_rate" id ="discount_rate" class="<?=$class_error_discount_rate; ?>">		
							<option value=""  <?php echo set_select('discount_rate',0, ( !empty($data['discount_rate']) && $data['discount_rate'] == "0" ? TRUE : FALSE )); ?>></option>
							<option value="1" <?php echo set_select('discount_rate',1, ( !empty($data['discount_rate']) && $data['discount_rate'] == "1" ? TRUE : FALSE )); ?>>1</option>
							<option value="2" <?php echo set_select('discount_rate',2, ( !empty($data['discount_rate']) && $data['discount_rate'] == "2" ? TRUE : FALSE )); ?>>2</option>
							<option value="3" <?php echo set_select('discount_rate',3, ( !empty($data['discount_rate']) && $data['discount_rate'] == "3" ? TRUE : FALSE )); ?>>3</option>
							<option value="4" <?php echo set_select('discount_rate',4, ( !empty($data['discount_rate']) && $data['discount_rate'] == "4" ? TRUE : FALSE )); ?>>4</option>
							<option value="5" <?php echo set_select('discount_rate',5, ( !empty($data['discount_rate']) && $data['discount_rate'] == "5" ? TRUE : FALSE )); ?>>5</option>
							<option value="6" <?php echo set_select('discount_rate',6, ( !empty($data['discount_rate']) && $data['discount_rate'] == "6" ? TRUE : FALSE )); ?>>6</option>
							<option value="7" <?php echo set_select('discount_rate',7, ( !empty($data['discount_rate']) && $data['discount_rate'] == "7" ? TRUE : FALSE )); ?>>7</option>
							<option value="8" <?php echo set_select('discount_rate',8, ( !empty($data['discount_rate']) && $data['discount_rate'] == "8" ? TRUE : FALSE )); ?>>8</option>
							<option value="9" <?php echo set_select('discount_rate',9, ( !empty($data['discount_rate']) && $data['discount_rate'] == "9" ? TRUE : FALSE )); ?>>9</option>
							<option value="10" <?php echo set_select('discount_rate',10, ( !empty($data['discount_rate']) && $data['discount_rate'] == "10" ? TRUE : FALSE )); ?>>10</option>
							<option value="15" <?php echo set_select('discount_rate',15, ( !empty($data['discount_rate']) && $data['discount_rate'] == "15" ? TRUE : FALSE )); ?>>15</option>
							<option value="20" <?php echo set_select('discount_rate',20, ( !empty($data['discount_rate']) && $data['discount_rate'] == "20" ? TRUE : FALSE )); ?>>20</option>
							<option value="25" <?php echo set_select('discount_rate',25, ( !empty($data['discount_rate']) && $data['discount_rate'] == "25" ? TRUE : FALSE )); ?>>25</option>
							<option value="30" <?php echo set_select('discount_rate',30, ( !empty($data['discount_rate']) && $data['discount_rate'] == "30" ? TRUE : FALSE )); ?>>30</option>
							<option value="35" <?php echo set_select('discount_rate',35, ( !empty($data['discount_rate']) && $data['discount_rate'] == "35" ? TRUE : FALSE )); ?>>35</option>
							<option value="40" <?php echo set_select('discount_rate',40, ( !empty($data['discount_rate']) && $data['discount_rate'] == "40" ? TRUE : FALSE )); ?>>40</option>
							<option value="45" <?php echo set_select('discount_rate',45, ( !empty($data['discount_rate']) && $data['discount_rate'] == "45" ? TRUE : FALSE )); ?>>45</option>
							<option value="50" <?php echo set_select('discount_rate',50, ( !empty($data['discount_rate']) && $data['discount_rate'] == "50" ? TRUE : FALSE )); ?>>50</option>

						</select>
						</div>
						&#37;
						<span style="color:red" class="php-error">
							<?php echo form_error('discount_rate'); ?>	
						</span>	
						<div id="discount"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>販売促進費<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_point = !empty(form_error('reward_point')) ? "error" : "";
							$class_error_reward_point_rate = !empty(form_error('reward_point_rate')) ? "error" : "";
						?>	
						<input type="tel" id ="reward_point" name="reward_point" value="<?php if($reward_point == 0){echo '';}else{echo $reward_point;} ?>" placeholder="" class="w50 <?=$class_error_reward_point; ?>">
						円　or
						<div class="select_box w65">
						<select name="reward_point_rate" id ="reward_point_rate" class="<?=$class_error_reward_point_rate; ?>">
							<option value=""  <?php echo set_select('reward_point_rate',0, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "0" ? TRUE : FALSE )); ?>></option>
							<option value="1" <?php echo set_select('reward_point_rate',1, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "1" ? TRUE : FALSE )); ?>>1</option>
							<option value="2" <?php echo set_select('reward_point_rate',2, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "2" ? TRUE : FALSE )); ?>>2</option>
							<option value="3" <?php echo set_select('reward_point_rate',3, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "3" ? TRUE : FALSE )); ?>>3</option>
							<option value="4" <?php echo set_select('reward_point_rate',4, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "4" ? TRUE : FALSE )); ?>>4</option>
							<option value="5" <?php echo set_select('reward_point_rate',5, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "5" ? TRUE : FALSE )); ?>>5</option>
							<option value="6" <?php echo set_select('reward_point_rate',6, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "6" ? TRUE : FALSE )); ?>>6</option>
							<option value="7" <?php echo set_select('reward_point_rate',7, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "7" ? TRUE : FALSE )); ?>>7</option>
							<option value="8" <?php echo set_select('reward_point_rate',8, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "8" ? TRUE : FALSE )); ?>>8</option>
							<option value="9" <?php echo set_select('reward_point_rate',9, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "9" ? TRUE : FALSE )); ?>>9</option>							
							<option value="10" <?php echo set_select('reward_point_rate',10, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "10" ? TRUE : FALSE )); ?>>10</option>
							<option value="15" <?php echo set_select('reward_point_rate',15, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "15" ? TRUE : FALSE )); ?>>15</option>
							<option value="20" <?php echo set_select('reward_point_rate',20, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "20" ? TRUE : FALSE )); ?>>20</option>
							<option value="25" <?php echo set_select('reward_point_rate',25, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "25" ? TRUE : FALSE )); ?>>25</option>
							<option value="30" <?php echo set_select('reward_point_rate',30, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "30" ? TRUE : FALSE )); ?>>30</option>
							<option value="35" <?php echo set_select('reward_point_rate',35, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "35" ? TRUE : FALSE )); ?>>35</option>
							<option value="40" <?php echo set_select('reward_point_rate',40, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "40" ? TRUE : FALSE )); ?>>40</option>	
							<option value="45" <?php echo set_select('reward_point_rate',45, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "45" ? TRUE : FALSE )); ?>>45</option>	
							<option value="50" <?php echo set_select('reward_point_rate',50, ( !empty($data['reward_point_rate']) && $data['reward_point_rate'] == "50" ? TRUE : FALSE )); ?>>50</option>	
						</select>
						</div>
						&#37;
						<span style="color:red" class="php-error"><?php echo form_error('reward_point_rate'); ?></span>
						<div id="reward"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>&nbsp;</th>
						<td class="txt tdkome">
						上記で設定した額の3割を運営費として頂き、<br>
						5割を紹介者、2割を企業紹介者へポイント付与致します。
						</td>
					 </tr>
					 <tr>
					 	<th>応援内容説明<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_content = !empty(form_error('reward_content')) ? "error" : "";
						?>
						<textarea cols="30" rows="4" name="reward_content" maxlength="2000" placeholder="MAX2,000文字" class="<?=$class_error_reward_content; ?>"><?php echo $reward_content;?></textarea>
						<span style="color:red" class="php-error"><?php echo form_error('reward_content'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 <!-- EDIT SUPPORT 1 -->
				 <!-- ADD/EDIT SUPPORT 2 -->
				 <table class="form form-add">
				 <?php 
				 if($flag == 1){
					$tmp_reward_from_data = set_value('tmp_reward_from_data') == false ? $second_support['reward_from_data'] : set_value('tmp_reward_from_data');
					$tmp_reward_to_data = set_value('tmp_reward_to_data') == false ? $second_support['reward_to_data'] : set_value('tmp_reward_to_data');
					$tmp_reward_from_time = set_value('tmp_reward_from_time') == false ? $second_support['reward_from_time'] : set_value('tmp_reward_from_time');
					$tmp_reward_to_time = set_value('tmp_reward_to_time') == false ? $second_support['reward_to_time'] : set_value('tmp_reward_to_time');
					$tmp_applied_lowest_price = set_value('tmp_applied_lowest_price') == false  ? $second_support['applied_lowest_price'] : set_value('tmp_applied_lowest_price');
					$tmp_discount_price = set_value('tmp_discount_price') == false ? $second_support['discount_price'] : set_value('tmp_discount_price');
					$tmp_reward_point  = set_value('tmp_reward_point') == false ? $second_support['reward_point'] : set_value('tmp_reward_point');
					$tmp_reward_content  = set_value('tmp_reward_content') == false ? $second_support['reward_content'] : set_value('tmp_reward_content');
				}else{
					$tmp_reward_from_data = set_value('tmp_reward_from_data');
					$tmp_reward_to_data = set_value('tmp_reward_to_data');
					$tmp_reward_from_time = set_value('tmp_reward_from_time');
					$tmp_reward_to_time = set_value('tmp_reward_to_time');
					$tmp_applied_lowest_price = set_value('tmp_applied_lowest_price');
					$tmp_discount_price = set_value('tmp_discount_price');
					$tmp_reward_point  = set_value('tmp_reward_point');
					$tmp_reward_content  = set_value('tmp_reward_content');
				}
				?>
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>新規応援条件</h3></th>
					 </tr>
					  <tr>
						<td colspan="2" class="txt">
						<p class="kome">※新規で登録する応援条件は、10日後から日付指定可能です。</p>
						</td>
					 </tr>
					 <tr>
						<th>応援区分<span class="must">※</span></th>
						<td>
							<?php if($flag == 1){?>
							<input type="hidden" name="tmp_company_reward_id" value="<?php echo $second_support['company_reward_id'] ;?>">
							<?php }?>
							<input type="hidden" name="flag" value="<?php echo $flag; ?>">
							<?php
								$class_error_reward_group_tmp = !empty(form_error('tmp_reward_group')) ? "error" : "";
							?>
							<div class="select_box">
							<select name="tmp_reward_group" id="tmp_reward_group" class="<?=$class_error_reward_group_tmp; ?>">
								<option value="1" <?php echo set_select('tmp_reward_group',1, ( !empty($second_support['reward_group']) && $second_support['reward_group'] == "1" ? TRUE : FALSE )); ?>>通常応援</option>
								<option value="2" <?php echo set_select('tmp_reward_group',2, ( !empty($second_support['reward_group']) && $second_support['reward_group'] == "2" ? TRUE : FALSE )); ?>>応援不要企業寄付</option>
								<option value="3" <?php echo set_select('tmp_reward_group',3, ( !empty($second_support['reward_group']) && $second_support['reward_group'] == "3" ? TRUE : FALSE )); ?>>寄付</option>				
							</select>
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_group'); ?></span>
							<div class="call-back-reward_group"></div>
							
							</div>
						</td>
					 </tr>
					 <tr>
						<th>応援対象年月日<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_data_tmp = !empty(form_error('tmp_reward_from_data')) ? "error" : "";
							?>
							<input onchange="checkFormHasData(this.value)" type="date" id="tmp_fromDate" name="tmp_reward_from_data" value="<?php echo $tmp_reward_from_data; ?>" placeholder="" class="<?=$class_error_reward_from_data_tmp; ?>">
<!-- 						<input type="hidden" name="tmp_reward_from_data_hidden" value=""/>
 -->						<div class="call-back-reward_from_data"></div>
 							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_from_data'); ?></span>
						</td>
					 </tr>
					 <tr>
						<th>応援対象年月日<br>To</th>
						<td>
							<?php
								$class_error_reward_to_data_tmp = !empty(form_error('tmp_reward_to_data')) ? "error" : "";
							?>
							
							<input onchange="checkFormHasData(this.value)" type="date" id="tmp_toDate" name="tmp_reward_to_data" value="<?php echo $tmp_reward_to_data; ?>" placeholder="" class="<?=$class_error_reward_to_data_tmp; ?>">
						<div class="error-js"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_to_data'); ?></span>
						</td>
					 </tr>
					 <tr>
						<th>応援対象時間<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_time_tmp = !empty(form_error('tmp_reward_from_time')) ? "error" : "";
							?>
							<input onchange="checkFormHasData(this.value)" type="time" id="tmp_fromTime" name="tmp_reward_from_time" value="<?php echo $tmp_reward_from_time; ?>" placeholder="" class="<?=$class_error_reward_from_time_tmp; ?>">
						<div class="error-js"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_from_time'); ?></span>
						</td>
					 </tr>
					 <tr>
						<th>応援対象時間<br>To</th>
						<td>
							<?php
								$class_error_reward_to_time_tmp = !empty(form_error('tmp_reward_to_time')) ? "error" : "";
							?>
							<input onchange="checkFormHasData(this.value)" type="time" id="tmp_toTime" name="tmp_reward_to_time" value="<?php echo $tmp_reward_to_time; ?>" placeholder="" class="<?=$class_error_reward_to_time_tmp; ?>">
						<div class="error-js"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_to_time'); ?></span>
						</td>
					 </tr>
					 <tr>
					 	<th>応援適用最低金額<span class="must">※</span></th>
						<td>
						<?php
							$class_error_applied_lowest_price_tmp = !empty(form_error('tmp_applied_lowest_price')) ? "error" : "";
						?>	
						<input onchange="checkFormHasData(this.value)" type="tel" id="tmp_Tel" name="tmp_applied_lowest_price" value="<?php echo $tmp_applied_lowest_price; ?>" placeholder="" class="w150 <?=$class_error_applied_lowest_price_tmp; ?>"> 円
						<div class="error-js"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_applied_lowest_price'); ?></span>
						</td>
					 </tr>
					 <tr>
					 	<th>購入者割引<span class="must">※</span></th>
						<td>
						<div class="error-js"></div>
						<?php
							$class_error_discount_price_tmp = !empty(form_error('tmp_discount_price')) ? "error" : "";
							$class_error_discount_rate_tmp = !empty(form_error('tmp_discount_rate')) ? "error" : "";
						?>	
						<input onBlur="checkFormHasData(this.value)" type="tel" id ="tmp_discount_price" name="tmp_discount_price" value="<?php if($tmp_discount_price == 0){echo '';}else{echo $tmp_discount_price;} ?>" placeholder="" class="w50 <?=$class_error_discount_price_tmp; ?>">
						円　or
						<div class="select_box w65">
						<select onChange="checkFormHasData(this.value)" name="tmp_discount_rate" id ="tmp_discount_rate" class="<?=$class_error_discount_rate_tmp; ?>">
							<option value=""  <?php echo set_select('tmp_discount_rate',0, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "0" ? TRUE : FALSE )); ?>></option>
							<option value="1" <?php echo set_select('tmp_discount_rate',1, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "1" ? TRUE : FALSE )); ?>>1</option>
							<option value="2" <?php echo set_select('tmp_discount_rate',2, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "2" ? TRUE : FALSE )); ?>>2</option>
							<option value="3" <?php echo set_select('tmp_discount_rate',3, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "3" ? TRUE : FALSE )); ?>>3</option>
							<option value="4" <?php echo set_select('tmp_discount_rate',4, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "4" ? TRUE : FALSE )); ?>>4</option>
							<option value="5" <?php echo set_select('tmp_discount_rate',5, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "5" ? TRUE : FALSE )); ?>>5</option>
							<option value="6" <?php echo set_select('tmp_discount_rate',6, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "6" ? TRUE : FALSE )); ?>>6</option>
							<option value="7" <?php echo set_select('tmp_discount_rate',7, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "7" ? TRUE : FALSE )); ?>>7</option>
							<option value="8" <?php echo set_select('tmp_discount_rate',8, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "8" ? TRUE : FALSE )); ?>>8</option>
							<option value="9" <?php echo set_select('tmp_discount_rate',9, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "9" ? TRUE : FALSE )); ?>>9</option>
							<option value="10" <?php echo set_select('tmp_discount_rate',10, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "10" ? TRUE : FALSE )); ?>>10</option>
							<option value="15" <?php echo set_select('tmp_discount_rate',15, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "15" ? TRUE : FALSE )); ?>>15</option>
							<option value="20" <?php echo set_select('tmp_discount_rate',20, ( !empty($second_support['discount_rate']) && $second_support['discount_rate'] == "20" ? TRUE : FALSE )); ?>>20</option>
						</select>

						</div>
						&#37;
						<div id="discount_add"></div>
						<span style="color:red" class="php-error">
							<?php echo form_error('tmp_discount_rate'); ?>	
						</span>		
						</td>
					 </tr>
					 <tr>
					 	<th>販売促進費<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_point_tmp = !empty(form_error('tmp_reward_point')) ? "error" : "";
							$class_error_reward_point_rate_tmp = !empty(form_error('tmp_reward_point_rate')) ? "error" : "";
						?>	
						<input onBlur="checkFormHasData(this.value)" type="tel" id ="tmp_reward_point" name="tmp_reward_point" value="<?php if($tmp_reward_point == 0){echo '';}else{echo $tmp_reward_point;} ?>" placeholder="" class="w50 <?=$class_error_reward_point_tmp; ?>">
						円　or
						<div class="select_box w65">
						<select onChange="checkFormHasData(this.value)" name="tmp_reward_point_rate" id ="tmp_reward_point_rate" class="<?=$class_error_reward_point_rate_tmp; ?>">
							<option value=""  <?php echo set_select('tmp_reward_point_rate',0, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "0" ? TRUE : FALSE )); ?>></option>
							<option value="1" <?php echo set_select('tmp_reward_point_rate',1, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "1" ? TRUE : FALSE )); ?>>1</option>
							<option value="2" <?php echo set_select('tmp_reward_point_rate',2, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "2" ? TRUE : FALSE )); ?>>2</option>
							<option value="3" <?php echo set_select('tmp_reward_point_rate',3, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "3" ? TRUE : FALSE )); ?>>3</option>
							<option value="4" <?php echo set_select('tmp_reward_point_rate',4, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "4" ? TRUE : FALSE )); ?>>4</option>
							<option value="5" <?php echo set_select('tmp_reward_point_rate',5, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "5" ? TRUE : FALSE )); ?>>5</option>
							<option value="10" <?php echo set_select('tmp_reward_point_rate',10, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "10" ? TRUE : FALSE )); ?>>10</option>
							<option value="15" <?php echo set_select('tmp_reward_point_rate',15, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "15" ? TRUE : FALSE )); ?>>15</option>
							<option value="20" <?php echo set_select('tmp_reward_point_rate',20, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "20" ? TRUE : FALSE )); ?>>20</option>
							<option value="25" <?php echo set_select('tmp_reward_point_rate',25, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "25" ? TRUE : FALSE )); ?>>25</option>
							<option value="30" <?php echo set_select('tmp_reward_point_rate',30, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "30" ? TRUE : FALSE )); ?>>30</option>
							<option value="35" <?php echo set_select('tmp_reward_point_rate',35, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "35" ? TRUE : FALSE )); ?>>35</option>
							<option value="40" <?php echo set_select('tmp_reward_point_rate',40, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "40" ? TRUE : FALSE )); ?>>40</option>	
							<option value="40" <?php echo set_select('tmp_reward_point_rate',45, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "45" ? TRUE : FALSE )); ?>>45</option>	
							<option value="50" <?php echo set_select('tmp_reward_point_rate',50, ( !empty($second_support['reward_point_rate']) && $second_support['reward_point_rate'] == "50" ? TRUE : FALSE )); ?>>50</option>	
						</select>
						</div>
						&#37;
						<div id="reward_add"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_point'); ?></span>
						</td>
					 </tr>
					 <tr>
					 	<th>&nbsp;</th>
						<td class="txt tdkome">
						上記で設定した額の3割を運営費として頂き、<br>
						5割を紹介者、2割を企業紹介者へポイント付与致します。
						</td>
					 </tr>
					 <tr>
					 	<th>応援内容説明<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_content_tmp = !empty(form_error('tmp_reward_content')) ? "error" : "";
						?>
						<textarea id="tmp_reward_content" onchange="checkFormHasData(this.value)" cols="30" rows="4" name="tmp_reward_content" maxlength="2000" placeholder="MAX2,000文字" class="<?=$class_error_reward_content_tmp; ?>"><?php echo $tmp_reward_content;?></textarea>
						<div class="error-js"></div>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_content'); ?></span>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>メールアドレス</h3></th>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<input type="email" name="mail" maxlength="255" value="<?php echo !empty($company_info->mail) ? $company_info->mail : set_value('mail'); ?>" placeholder="">
						<span style="color:red"><?php echo form_error('mail'); ?></span>
						<div id="mail"></div>
						</td>
				 	</tr>
					 <tr>
						<th class="h3" colspan="2"><h3>パスワード</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
						<p class="kome">※ログインパスワードと企業情報変更パスワードは同じものは使用不可</p>
						</td>
					 </tr>
					  <tr>
					 	<th>ログイン<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
						$length_password_login = $company_info->password_login_length;
							$password_login = '';
							for($i = 0; $i < $length_password_login; $i++) {
								$password_login .= '●';
							}
						?>

						<?php
							$class_error_password_login = !empty(form_error('password_login')) ? "error" : "";
						?>	
						<input type="password" name="password_login" value="<?php echo set_value('password_login'); ?>" placeholder="<?php echo $password_login; ?>" class="<?=$class_error_password_login; ?>">

						<span class="att">(半角英数字記号8文字以上)</span>
						<span style="color:red"><?php echo form_error('password_login'); ?></span>
						</td>
					 </tr>
					 <tr>
					 	<th>企業情報変更<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
						$length_password_reward = $company_info->password_reward_length;
						$password_reward = '';
						for($i = 0; $i < $length_password_reward; $i++) {
							$password_reward .= '●';
						}
						?>

						<?php
							$class_error_password_reward = !empty(form_error('password_reward')) ? "error" : "";
						?>	
						<input type="password" name="password_reward" value="<?php echo set_value('password_reward'); ?>" placeholder="<?php echo $password_reward; ?>" class="<?=$class_error_password_reward; ?>">
						<span class="att">(半角英数字記号8文字以上)</span>
						<span style="color:red"><?php echo form_error('password_reward'); ?></span>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn_submit"><button type="submit" class="submit">登録</button></p>
				 <p class="btn gray"><a href="<?php echo base_url('company/detail'); ?>">戻る</a></p>
				 
			</form>	 
			</section>
		</article>
		<!--▲▲▲article▲▲▲-->
	</div>
	<!--▲▲▲main▲▲▲-->
<footer id="footer">
		<div class="footerCopy">
			<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
		</div>
	</footer>
	<!--▲▲▲footer▲▲▲-->
</div>
<!--▲▲▲contents▲▲▲-->
<script type="text/javascript">
	// $('#tmp_reward_group').on('change',function(){
	// 		get_all_input();
	// });
	// $('#tmp_reward_from_data').on('input',function(){
		
	// });
	// function get_all_input(){
	// 	$(".form-add :input").each(function(){
	// 		 return console.log($(this).val());
	// 	});
	// }

</script>