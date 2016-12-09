<style>
table.form tr th{
padding: 20px 0 0 8px;
}
#agree-error{
	float:none;
}    
</style>
<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
	</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form id = "signupForm1" action="<?php echo base_url('company/confirm/'); ?>" method="post" novalidate>
				<h2 class="kigyou">企業登録</h2>
				 <table class="form">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>企業情報</h3></th>
					 </tr>
					 <tr>
						<th>企業名<span class="must">※</span></th>
						<td>
						<?php
							$class_error_name = !empty(form_error('name')) ? "error" : "";
						?>
						<input type="text" name="name" maxlength="50" value="<?php echo set_value('name');?>" placeholder="" class="<?=$class_error_name; ?>">	
						<span style="color:red"><?php echo form_error('name'); ?></span>					
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>郵便番号<span class="must">※</span></th>
						<td>
						<?php
							$class_error_1 = !empty(form_error('post_code_1')) ? "error" : "";
							$class_error_2 = !empty(form_error('post_code_2')) ? "error" : "";
						?>
						〒 <input type="tel" name="post_code_1" maxlength="3" value="<?php echo set_value('post_code_1');?>" placeholder="" class="w50 <?=$class_error_1; ?>">
						-
						<input type="tel" name="post_code_2" maxlength="4" value="<?php echo set_value('post_code_2');?>" placeholder="" class="w50 <?=$class_error_2; ?>">
						<?php
						if(form_error('post_code_1')) : ?>
							<span style="color:red"><?php echo form_error('post_code_1'); ?></span>
						<?php elseif (form_error('post_code_2')): ?>
							<span style="color:red"><?php echo form_error('post_code_2'); ?></span>
						<?php endif; ?>
						<div id="post-code"></div>
						</td>
					 </tr>
					 <tr>
						<th>都道府県<span class="must">※</span></th>
						<td>
						<?php
							$class_error_prefecture_id = !empty(form_error('prefecture_id')) ? "error" : "";
						?>
							<div class="select_box">
							<select name = "prefecture_id" class="<?=$class_error_prefecture_id; ?>">
								<?php foreach($prefecture as $key_prefecture => $value_prefecture){ ?>
								<option value="<?php echo $key_prefecture;?>" <?php echo set_select('prefecture_id',  $key_prefecture); ?>><?php echo $value_prefecture; ?></option>
								<?php } ?>
							</select>
							<span style="color:red"><?php echo form_error('prefecture_id'); ?></span>
							<div class="error-js"></div>
							</div>
						</td>
					 </tr>
					 <tr>
						<th>市区町村<span class="must">※</span></th>
						<td>
						<?php
							$class_error_city = !empty(form_error('city')) ? "error" : "";
						?>
						<input type="text" name="city" maxlength="30" value="<?php echo set_value('city');?>" placeholder="" class="<?=$class_error_city; ?>">
						<span style="color:red"><?php echo form_error('city'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>番地以降<span class="must">※</span></th>
						<td>
						<?php
							$class_error_street_address = !empty(form_error('street_address')) ? "error" : "";
						?>
						<input type="text" name="street_address"  maxlength="100" value="<?php echo set_value('street_address');?>" placeholder="" class="<?=$class_error_street_address; ?>">
						<span style="color:red"><?php echo form_error('street_address'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>最寄駅</th>
						<td>
						<?php
							$class_error_station = !empty(form_error('station')) ? "error" : "";
						?>
						<input type="text" name="station" maxlength="100" value="<?php echo set_value('station');?>" placeholder="" class="<?=$class_error_station; ?>">
						<span style="color:red"><?php echo form_error('station'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>企業連絡先<span class="must">※</span></th>
						<td>
						<?php
							$class_error_tel_1 = !empty(form_error('tel_1')) ? "error" : "";
							$class_error_tel_2 = !empty(form_error('tel_2')) ? "error" : "";
							$class_error_tel_3 = !empty(form_error('tel_3')) ? "error" : "";
						?>
						<input type="tel" name="tel_1" maxlength="5" value="<?php echo set_value('tel_1');?>" placeholder="" class="w50 <?=$class_error_tel_1; ?>">
						-
						<input type="tel" name="tel_2" maxlength="5" value="<?php echo set_value('tel_2');?>" placeholder="" class="w50 <?=$class_error_tel_2; ?>">
						-
						<input type="tel" name="tel_3" maxlength="5" value="<?php echo set_value('tel_3');?>" placeholder="" class="w50 <?=$class_error_tel_3; ?>">
						<?php
							if(form_error('tel_1')) :
						?>
							<span style="color:red"><?php echo form_error('tel_1'); ?></span>
						<?php elseif (form_error('tel_2')): ?>
							<span style="color:red"><?php echo form_error('tel_2'); ?></span>
						<?php elseif (form_error('tel_3')): ?>
							<span style="color:red"><?php echo form_error('tel_3'); ?></span>
						<?php endif; ?>
						<div id="tel-num"></div>
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<?php
							$class_error_mail = !empty(form_error('mail')) ? "error" : "";
						?>	
						<input type="email" name="mail" maxlength="255" value="<?php echo set_value('mail');?>" placeholder="" class="<?=$class_error_mail; ?>">
						<span style="color:red" class="error-controller"><?php echo form_error('mail'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th>URL</th>
						<td>
						<?php
							$class_error_outside_url = !empty(form_error('outside_url')) ? "error" : "";
						?>	
						<input type="url" name="outside_url" maxlength="255" value="<?php echo set_value('outside_url');?>" placeholder="" class="<?=$class_error_outside_url; ?>">
						<span style="color:red" class="error-controller"><?php echo form_error('outside_url'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th style="padding: 55px 0 0 8px;">会社PR</th>
						<td>
						<?php
							$class_error_public_relations = !empty(form_error('public_relations')) ? "error" : "";
						?>		
						<textarea cols="30" rows="4" name="public_relations" maxlength="1000" placeholder="MAX1,000文字" class="<?=$class_error_public_relations; ?>"><?php echo set_value('public_relations');?></textarea>
						<span style="color:red"><?php echo form_error('public_relations'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>企業補足情報</h3></th>
					 </tr>
					 <tr>
					 	<th>担当者名<span class="must">※</span></th>
						<td>
						<?php
							$class_error_representative = !empty(form_error('representative')) ? "error" : "";
						?>
						<input type="text" name="representative" maxlength="50" value="<?php echo set_value('representative');?>" placeholder="" class="<?=$class_error_representative; ?>">
						<span style="color:red"><?php echo form_error('representative'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>担当者連絡先<span class="must">※</span></th>
						<td>
						<?php
							$class_error_rep_tel_1 = !empty(form_error('rep_tel_1')) ? "error" : "";
							$class_error_rep_tel_2 = !empty(form_error('rep_tel_2')) ? "error" : "";
							$class_error_rep_tel_3 = !empty(form_error('rep_tel_3')) ? "error" : "";
						?>
						<input type="tel" name="rep_tel_1" maxlength="5" value="<?php echo set_value('rep_tel_1');?>" placeholder="" class="w50 <?=$class_error_rep_tel_1; ?>">
						-
						<input type="tel" name="rep_tel_2" maxlength="5" value="<?php echo set_value('rep_tel_2');?>" placeholder="" class="w50 <?=$class_error_rep_tel_2; ?>">
						-
						<input type="tel" name="rep_tel_3" maxlength="5" value="<?php echo set_value('rep_tel_3');?>" placeholder="" class="w50 <?=$class_error_rep_tel_3; ?>">
						<?php
							if(form_error('rep_tel_1')) :
						?>
							<span style="color:red"><?php echo form_error('rep_tel_1'); ?></span>
						<?php
							elseif (form_error('rep_tel_2')) :
						?>
							<span style="color:red"><?php echo form_error('rep_tel_2'); ?></span>
						<?php
							elseif (form_error('rep_tel_3')) :
						?>
							<span style="color:red"><?php echo form_error('rep_tel_3'); ?></span>
						<?php endif; ?>
						<div id="rep_tel"></div>
						</td>
					 </tr>
					 <tr>
					 	<th style="padding:8px 0 0 8px">担当者<br>メールアドレス<span class="must">※</span></th>
						<td>
						<?php
							$class_error_rep_address = !empty(form_error('rep_address')) ? "error" : "";
						?>
						<input type="email" name="rep_address" maxlength="255" value="<?php echo set_value('rep_address');?>" placeholder="" class="<?=$class_error_rep_address; ?>">
						<span style="color:red"><?php echo form_error('rep_address'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>企業紹介者ID<span class="must">※</span></th>
						<td>
						<?php
							$class_error_introduce_uid = !empty(form_error('introduce_uid')) ? "error" : "";
						?>
						<input type="text" name="introduce_uid" maxlength="12" value="<?php echo set_value('introduce_uid');?>" placeholder="" class="<?=$class_error_introduce_uid; ?>" onfocus="hidePHPMessageByName('introduce_uid')">
						<span style="color:red" class="error-introduce_uid"><?php echo form_error('introduce_uid'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>カテゴリ<span class="must">※</span></th>
						<td>
						<?php
							$class_error_category_id = !empty(form_error('category_id')) ? "error" : "";
						?>
							<div class="select_box">
								<select name = "category_id" class="<?=$class_error_category_id; ?>">
								<?php foreach($category as $key_category => $value_category){ ?>
								<option value="<?php echo $key_category;?>" <?php echo set_select('category_id',  $key_category); ?>><?php echo $value_category;?></option>
								<?php } ?>
							</select>
							<span style="color:red"><?php echo form_error('category_id'); ?></span>
							<div class="error-js"></div>
							</div>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>口座情報</h3></th>
					 </tr>
					 <tr>
					 	<th>金融機関名<span class="must">※</span></th>
						<td>
						<?php
							$class_error_bank_name = !empty(form_error('bank_name')) ? "error" : "";
						?>
						<input type="text" name="bank_name" maxlength="50" value="<?php echo set_value('bank_name');?>" placeholder="" class="w150 <?=$class_error_bank_name; ?>"> <span class="bold">銀行</span>
						<span style="color:red"><?php echo form_error('bank_name'); ?></span>
						<div id="bank_name"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>店番号<span class="must">※</span></th>
						<td>
						<?php
							$class_error_bank_branch_number = !empty(form_error('bank_branch_number')) ? "error" : "";
						?>
						<input type="tel" name="bank_branch_number" maxlength="50" value="<?php echo set_value('bank_branch_number');?>" placeholder="" class="<?=$class_error_bank_branch_number; ?>">
						<span style="color:red"><?php echo form_error('bank_branch_number'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>預金種目<span class="must">※</span></th>
						<td>
						<input type="radio" id="radio01" name="bank_type" 
						<?php echo set_radio('bank_type', 0, TRUE);?>  value="0"/><label class="radio" for="radio01">普通預金</label>
						<input type="radio" id="radio02" name="bank_type" 
						<?php echo set_radio('bank_type', 1 ); ?>  value="1"/><label class="radio" for="radio02">当座預金</label>
						<span style="color:red"><?php echo form_error('bank_type'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>口座番号<span class="must">※</span></th>
						<td>
						<?php
							$class_error_bank_number = !empty(form_error('bank_number')) ? "error" : "";
						?>
						<input type="tel" name="bank_number" maxlength="20" value="<?php echo set_value('bank_number');?>" placeholder="" class="<?=$class_error_bank_number; ?>">
						<span style="color:red"><?php echo form_error('bank_number'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>口座名義人<span class="must">※</span></th>
						<td>
						<?php
							$class_error_bank_holder = !empty(form_error('bank_holder')) ? "error" : "";
						?>
						<input type="text" name="bank_holder" maxlength="50" value="<?php echo set_value('bank_holder');?>" placeholder="" class="<?=$class_error_bank_holder; ?>">
						<span style="color:red"><?php echo form_error('bank_holder'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>パスワード</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
						<p>※ログインパスワードと企業情報変更パスワードは同じものは使用不可</p>
						</td>
					 </tr>
					 <tr>
					 	<th style="padding:10px 0 0 8px">ログイン<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$class_error_password_login = !empty(form_error('password_login')) ? "error" : "";
						?>
						<input type="password" id="password_login" maxlength="50" name="password_login" value="<?php echo set_value('password_login');?>" placeholder="" class="<?=$class_error_password_login; ?>">
						<span style="color:red"><?php echo form_error('password_login'); ?></span>
						<div class="error-js"></div>
						<span class="att">(半角英数字記号8文字以上)</span>
						</td>
					 </tr>
					 <tr>
					 	<th style="padding:10px 0 0 8px">企業情報変更<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$class_error_password_reward = !empty(form_error('password_reward')) ? "error" : "";
						?>
						<input type="password" id="password_reward" maxlength="50" name="password_reward" value="<?php echo set_value('password_reward');?>" placeholder="" class="<?=$class_error_password_reward; ?>">
						<span style="color:red"><?php echo form_error('password_reward'); ?></span>
						<div class="error-js"></div>
						<span class="att">(半角英数字記号8文字以上)</span>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				<h2 class="txt_only">応援条件登録</h2>
				
				 <table class="form">
				 <tbody>
					 <tr>
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
								<option value="1" <?php echo set_select('reward_group',  1); ?>>通常応援</option>
								<option value="2" <?php echo set_select('reward_group',  2); ?>>応援不要企業寄付</option>
								<option value="3" <?php echo set_select('reward_group',  3); ?>>寄付</option>
							</select>
							<span style="color:red"><?php echo form_error('reward_group'); ?></span>
							<div class="error-js"></div>
							</div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px" >応援対象年月日<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_data = !empty(form_error('reward_from_data')) ? "error" : "";
							?>
							<input type="date" id ="fromDate" name="reward_from_data" value="<?php echo set_value('reward_from_data'); ?>" placeholder="" class="<?=$class_error_reward_from_data; ?>" onfocus="hidePHPMessage()">
							<span style="color:red" class="error-controller"><?php echo form_error('reward_from_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象年月日<br>To</th>
						<td>
							<?php
								$class_error_reward_to_data = !empty(form_error('reward_to_data')) ? "error" : "";
							?>
							<input type="date" id="toDate" name="reward_to_data" value="<?php echo set_value('reward_to_data'); ?>" placeholder="" class="<?=$class_error_reward_to_data; ?>" onfocus="hidePHPMessage()">
							<span style="color:red" class="error-controller"><?php echo form_error('reward_to_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_time = !empty(form_error('reward_from_time')) ? "error" : "";
							?>
							<input type="time" id ="fromTime" name="reward_from_time" value="<?php echo set_value('reward_from_time'); ?>" placeholder="" class="<?=$class_error_reward_from_time; ?>">
							<span style="color:red"><?php echo form_error('reward_from_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>To</th>
						<td>
							<?php
								$class_error_reward_to_time = !empty(form_error('reward_to_time')) ? "error" : "";
							?>
							<input type="time" id ="toTime" name="reward_to_time" value="<?php echo set_value('reward_to_time'); ?>" placeholder="" class="<?=$class_error_reward_to_time; ?>">
							<span style="color:red"><?php echo form_error('reward_to_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th><span style="font-size:11px">応援適用最低金額<span class="must">※</span></span></th>
						<td>
						<?php
							$class_error_applied_lowest_price = !empty(form_error('applied_lowest_price')) ? "error" : "";
						?>
						<input type="tel" name="applied_lowest_price" maxlength="9" value="<?php echo set_value('applied_lowest_price'); ?>" placeholder="" class="w150 <?=$class_error_applied_lowest_price; ?>"> 円
						<span style="color:red"><?php echo form_error('applied_lowest_price'); ?></span>
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
						<input type="tel" id ="discount_price" min="0" maxlength="9" name="discount_price" value="<?php echo set_value('discount_price'); ?>" placeholder="" class="w50 <?=$class_error_discount_price; ?>">
						円　or
						<div class="select_box w65">
						<select name="discount_rate" id ="discount_rate" class="<?=$class_error_discount_rate; ?>">
							<option value=""></option>
							<option value="1" <?php echo set_select('discount_rate',  1); ?>>1</option>
							<option value="2" <?php echo set_select('discount_rate',  2); ?>>2</option>
							<option value="3" <?php echo set_select('discount_rate',  3); ?>>3</option>
							<option value="4" <?php echo set_select('discount_rate',  4); ?>>4</option>
							<option value="5" <?php echo set_select('discount_rate',  5); ?>>5</option>
							<option value="6" <?php echo set_select('discount_rate',  6); ?>>6</option>
							<option value="7" <?php echo set_select('discount_rate',  7); ?>>7</option>
							<option value="8" <?php echo set_select('discount_rate',  8); ?>>8</option>
							<option value="9" <?php echo set_select('discount_rate',  9); ?>>9</option>
							<option value="10" <?php echo set_select('discount_rate',  10); ?>>10</option>
							<option value="15" <?php echo set_select('discount_rate',  15); ?>>15</option>
							<option value="20" <?php echo set_select('discount_rate',  20); ?>>20</option>
							<option value="25" <?php echo set_select('discount_rate',  25); ?>>25</option>
							<option value="30" <?php echo set_select('discount_rate',  30); ?>>30</option>
							<option value="35" <?php echo set_select('discount_rate',  35); ?>>35</option>
							<option value="40" <?php echo set_select('discount_rate',  40); ?>>40</option>
							<option value="45" <?php echo set_select('discount_rate',  45); ?>>45</option>
							<option value="50" <?php echo set_select('discount_rate',  50); ?>>50</option>

						</select>
						</div>
						&#37;
						<span style="color:red">
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
						<input type="tel" id ="reward_point" min="0" maxlength="9" name="reward_point" value="<?php echo set_value('reward_point'); ?>" placeholder="" class="w50 <?=$class_error_reward_point; ?>">
						円　or
						<div class="select_box w65">
						<select name="reward_point_rate" id ="reward_point_rate" class="<?=$class_error_reward_point_rate; ?>">
							<option value=""></option>
							<option value="1" <?php echo set_select('reward_point_rate',  1); ?>>1</option>
							<option value="2" <?php echo set_select('reward_point_rate',  2); ?>>2</option>
							<option value="3" <?php echo set_select('reward_point_rate',  3); ?>>3</option>
							<option value="4" <?php echo set_select('reward_point_rate',  4); ?>>4</option>
							<option value="5" <?php echo set_select('reward_point_rate',  5); ?>>5</option>
							<option value="6" <?php echo set_select('reward_point_rate',  6); ?>>6</option>
							<option value="7" <?php echo set_select('reward_point_rate',  7); ?>>7</option>
							<option value="8" <?php echo set_select('reward_point_rate',  8); ?>>8</option>
							<option value="9" <?php echo set_select('reward_point_rate',  9); ?>>9</option>
							<option value="10" <?php echo set_select('reward_point_rate',  10); ?>>10</option>
							<option value="15" <?php echo set_select('reward_point_rate',  15); ?>>15</option>
							<option value="20" <?php echo set_select('reward_point_rate',  20); ?>>20</option>
							<option value="25" <?php echo set_select('reward_point_rate',  25); ?>>25</option>
							<option value="30" <?php echo set_select('reward_point_rate',  30); ?>>30</option>
							<option value="35" <?php echo set_select('reward_point_rate',  35); ?>>35</option>
							<option value="40" <?php echo set_select('reward_point_rate',  40); ?>>40</option>
							<option value="45" <?php echo set_select('reward_point_rate',  45); ?>>45</option>
							<option value="50" <?php echo set_select('reward_point_rate',  50); ?>>50</option>
						</select>
						</div>
						&#37;
						<span style="color:red"><?php echo form_error('reward_point_rate'); ?></span>
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
					 	<th style="padding: 55px 0 0 8px;">応援内容説明<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_content = !empty(form_error('reward_content')) ? "error" : "";
						?>	
						<textarea cols="30" rows="4" name="reward_content" maxlength="2000" placeholder="MAX2,000文字" class="<?=$class_error_reward_content; ?>"><?php echo set_value('reward_content');?></textarea>
						<span style="color:red"><?php echo form_error('reward_content'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>利用規約</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
							<div class="note">
								<a href="<?php echo base_url('assets/pdf/CROSS INFINITY 企業利用規約.pdf') ?>" target="_blank">利用規約PDF</a><br>
								<span style="color:red"><?php echo form_error('agree'); ?></span>
								<input type="checkbox" name="agree" id="checkbox" value="1"/>								
								<label class="check" id="check-agree" for="checkbox">上記内容に同意する</label>
								<div style="z-index:999">								
								<div id="agree"></div>
								</div>
							</div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn_submit"><button type="submit" id="submit" class="submit">確認</button></p>
				 <p class="btn gray"><a href="<?php echo base_url('/');?>">戻る</a></p>
				 
			</form>	 
			</section>
		</article>
		<!--▲▲▲article▲▲▲-->
	</div>
	<!--▲▲▲main▲▲▲-->
	<!--▼▼▼footer▼▼▼-->
	<footer id="footer">
		<div class="footerCopy">
			<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
		</div>
	</footer>
	<!--▲▲▲footer▲▲▲-->
</div>
<script>
	$('input[type="tel"]').on('input',function(event){
    this.value = this.value.replace(/[^0-9]/g,'');
  });
</script>