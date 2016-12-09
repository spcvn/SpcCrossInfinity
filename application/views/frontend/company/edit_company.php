<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
		
		<?php $this->view('frontend/layout/_company_menu'); ?>
	
		</header><!--▼▼▼main▼▼▼-->
<div class="main">
	<!--▼▼▼article▼▼▼-->
	<article>
		<section>
		<form action="<?php echo base_url('company/edit/'); ?>" method="post" id='form_regist' novalidate>
			<h2 class="kigyou">マイページ編集 (企業)</h2>
			
			 <table class="form edit">
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
					<input type="text" name="name" maxlength="50" value="<?php echo !empty($company_info->name) ? $company_info->name : set_value('name'); ?>" placeholder="" class="<?=$class_error_name; ?>"> 
					<span style="color:red"><?php echo form_error('name'); ?></span>
					<div id="name"></div>
					</td>
				 </tr>
				 <tr>
					<th>郵便番号<span class="must">※</span></th>
					<td>
					<?php
						$post_code = preg_split ('/-/', $company_info->post_code);
						$post_code_1 = !empty($post_code[0]) ? $post_code[0] : set_value('post_code_1');
						$post_code_2 = !empty($post_code[1]) ? $post_code[1] : set_value('post_code_2');
					?>
					<?php
						$class_error_1 = !empty(form_error('post_code_1')) ? "error" : "";
						$class_error_2 = !empty(form_error('post_code_2')) ? "error" : "";
					?>

					〒 <input type="tel" name="post_code_1" maxlength="3" value="<?php echo $post_code_1; ?>" placeholder="" class="w50 <?=$class_error_1; ?>">
					-
					<input type="tel" name="post_code_2" maxlength="4" value="<?php echo $post_code_2; ?>" placeholder="" class="w50 <?=$class_error_2; ?>">
					
					<?php
					if(form_error('post_code_1')) : ?>
						<span style="color:red"><?php echo form_error('post_code_1'); ?></span>
					<?php elseif (form_error('post_code_2')): ?>
						<span style="color:red"><?php echo form_error('post_code_2'); ?></span>
					<?php endif; ?>
					<div style="clear: both"></div>
					<div id="post_code"></div>
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
							<?php foreach($prefecture as $key_prefecture => $value_prefecture){ 
								if($key_prefecture == $company_info->prefecture_id) {
									$default = TRUE;
								} else {
									$default = '';
								}
							?>
							<option value="<?php echo $key_prefecture;?>" <?php echo set_select('prefecture_id',  $key_prefecture, $default); ?>><?php echo $value_prefecture; ?></option>
							<?php } ?>
						</select>
						</div>
						<span style="color:red"><?php echo form_error('prefecture_id'); ?></span>
						<div id="prefecture_id"></div>
					</td>
				 </tr>
				 <tr>
					<th>市区町村<span class="must">※</span></th>
					<td>
					<?php
						$class_error_city = !empty(form_error('city')) ? "error" : "";
					?>
					<input type="text" name="city" maxlength="30" value="<?php echo !empty($company_info->city) ? $company_info->city : set_value('city'); ?>" placeholder="" class="<?=$class_error_city; ?>">
					<span style="color:red"><?php echo form_error('city'); ?></span>
					<div id="city"></div>
					</td>
				 </tr>
				 <tr>
					<th>番地以降<span class="must">※</span></th>
					<td>
					<?php
						$class_error_street_address = !empty(form_error('street_address')) ? "error" : "";
					?>
					<input type="text" name="street_address" maxlength="100" value="<?php echo !empty($company_info->street_address) ? $company_info->street_address : set_value('street_address'); ?>" placeholder="" class="<?=$class_error_street_address; ?>">
					<span style="color:red"><?php echo form_error('street_address'); ?></span>
					<div id="street_address"></div>
					</td>
				 </tr>
				 <tr>
					<th>最寄駅</th>
					<td>
					<?php
						$class_error_station = !empty(form_error('station')) ? "error" : "";
					?>
					<input type="text" name="station" maxlength="100" value="<?php echo !empty($company_info->station) ? $company_info->station : set_value('station'); ?>" placeholder="" class="<?=$class_error_station; ?>">
					<span style="color:red"><?php echo form_error('station'); ?></span>
					<div id="station"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>企業連絡先<span class="must">※</span></th>
					<td>
					<?php
 						$tel = preg_split ('/-/', $company_info->tel);
						$tel_1 = $tel[0] != '' ? $tel[0] : set_value('tel_1');
						$tel_2 = $tel[1] != '' ? $tel[1] : set_value('tel_2');
						$tel_3 = $tel[2] != '' ? $tel[2] : set_value('tel_3');
					?>

					<?php
						$class_error_tel_1 = !empty(form_error('tel_1')) ? "error" : "";
						$class_error_tel_2 = !empty(form_error('tel_2')) ? "error" : "";
						$class_error_tel_3 = !empty(form_error('tel_3')) ? "error" : "";
					?>
					<input type="tel" name="tel_1" maxlength="5" value="<?php echo $tel_1; ?>" placeholder="" class="w50 <?=$class_error_tel_1; ?>">
					-
					<input type="tel" name="tel_2" maxlength="5" value="<?php echo $tel_2; ?>" placeholder="" class="w50 <?=$class_error_tel_2; ?>">
					-
					<input type="tel" name="tel_3" maxlength="5" value="<?php echo $tel_3; ?>" placeholder="" class="w50 <?=$class_error_tel_3; ?>">
 					<?php
						if(form_error('tel_1')) :
					?>
						<span style="color:red"><?php echo form_error('tel_1'); ?></span>
					<?php elseif (form_error('tel_2')): ?>
						<span style="color:red"><?php echo form_error('tel_2'); ?></span>
					<?php elseif (form_error('tel_3')): ?>
						<span style="color:red"><?php echo form_error('tel_3'); ?></span>
					<?php endif; ?>
					<div id="tel"></div>
					</td>
				 </tr>
				 <tr>
					<th>URL</th>
					<td>
					<?php
						$class_error_outside_url = !empty(form_error('outside_url')) ? "error" : "";
					?>
					<input type="url" name="outside_url" maxlength="255" value="<?php echo !empty($company_info->outside_url) ? $company_info->outside_url : set_value('outside_url'); ?>" placeholder="" class="<?=$class_error_outside_url; ?>">
					<span style="color:red"><?php echo form_error('outside_url'); ?></span>
					<div id="outside_url"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>会社PR</th>
					<td>
					<?php
						$class_error_public_relations = !empty(form_error('public_relations')) ? "error" : "";
					?>
					<textarea cols="30" rows="4" name="public_relations" maxlength="1000" maxlength="1000" class="<?=$class_error_public_relations; ?>"><?php echo !empty($company_info->public_relations) ? $company_info->public_relations : set_value('public_relations'); ?></textarea>
					<span style="color:red"><?php echo form_error('public_relations'); ?></span>
					<div id="public_relations"></div>
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
					<input type="text" name="representative" maxlength="50" value="<?php echo !empty($company_info->representative) ? $company_info->representative : set_value('representative'); ?>" placeholder="" class="<?=$class_error_representative; ?>">
					<span style="color:red"><?php echo form_error('representative'); ?></span>
					<div id="representative"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>担当者連絡先<span class="must">※</span></th>
					<td>
					<?php
						$rep_tel = preg_split ('/-/', $company_info->rep_tel);
						$rep_tel_1 = $rep_tel[0] != '' ? $rep_tel[0] : set_value('rep_tel_1');
						$rep_tel_2 = $rep_tel[1] != '' ? $rep_tel[1] : set_value('rep_tel_2');
						$rep_tel_3 = $rep_tel[2] != '' ? $rep_tel[2] : set_value('rep_tel_3');
					?>

					<?php
						$class_error_rep_tel_1 = !empty(form_error('rep_tel_1')) ? "error" : "";
						$class_error_rep_tel_2 = !empty(form_error('rep_tel_2')) ? "error" : "";
						$class_error_rep_tel_3 = !empty(form_error('rep_tel_3')) ? "error" : "";
					?>
					<input type="tel" name="rep_tel_1" maxlength="5" value="<?php echo $rep_tel_1; ?>" placeholder="" class="w50 <?=$class_error_rep_tel_1; ?>">
					-
					<input type="tel" name="rep_tel_2" maxlength="5" value="<?php echo $rep_tel_2; ?>" placeholder="" class="w50 <?=$class_error_rep_tel_2; ?>">
					-
					<input type="tel" name="rep_tel_3" maxlength="5" value="<?php echo $rep_tel_3; ?>" placeholder="" class="w50 <?=$class_error_rep_tel_3; ?>">
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
				 	<th>担当者<br>メールアドレス<span class="must">※</span></th>
					<td>
					<?php
						$class_error_rep_address = !empty(form_error('rep_address')) ? "error" : "";
					?>
					<input type="email" name="rep_address" maxlength="255" value="<?php echo !empty($company_info->rep_address) ? $company_info->rep_address : set_value('rep_address'); ?>" placeholder="" class="<?=$class_error_rep_address; ?>">
					<span style="color:red"><?php echo form_error('rep_address'); ?></span>
					<div id="rep_address"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>企業紹介者ID<span class="must">※</span></th>
					<td>
					<?php
						$class_error_introduce_uid = !empty(form_error('introduce_uid')) ? "error" : "";
					?>
					<input type="text" name="introduce_uid" maxlength="12" value="<?php echo !empty($company_info->uid_name) ? $company_info->uid_name : set_value('introduce_uid'); ?>" placeholder="" class="<?=$class_error_introduce_uid; ?>">
					<span style="color:red"><?php echo form_error('introduce_uid'); ?></span>
					<div id="introduce_uid"></div>
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
								<?php foreach($category as $key_category => $value_category){ 
									if ($key_category == $company_info->category_id) {
										$selected = TRUE;
									} else {
										$selected = '';
									}
								?>
								<option value="<?php echo $key_category; ?>" <?php echo set_select('category_id',  $key_category, $selected); ?>><?php echo $value_category; ?></option>
								<?php } ?>
							</select>
						</div>
					<span style="color:red"><?php echo form_error('category_id'); ?></span>
					<div id="category_id"></div>
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
					<input type="text" name="bank_name" maxlength="50" value="<?php echo !empty($company_info->bank_name) ? $company_info->bank_name : set_value('bank_name'); ?>" placeholder="" class="w150 <?=$class_error_bank_name; ?>"> <span class="bold">銀行</span>
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
					<input type="tel" name="bank_branch_number" maxlength="50" value="<?php echo !empty($company_info->bank_branch_number) ? $company_info->bank_branch_number : set_value('bank_branch_number'); ?>" placeholder="" class="<?=$class_error_bank_branch_number; ?>">
					<span style="color:red"><?php echo form_error('bank_branch_number'); ?></span>
					<div id="bank_branch_number"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>預金種目<span class="must">※</span></th>
					<td>
						<?php
							if($company_info->bank_type == 0) {
								$checked_1 = TRUE;
								$checked_2 = '';
							} else {
								$checked_1 = '';
								$checked_2 = TRUE;
							}
						?>
						<input type="radio" id="radio01" name="bank_type" 
						<?php echo set_radio('bank_type', 0, $checked_1); ?>  value="0"/><label class="radio" for="radio01">普通預金</label>
						<input type="radio" id="radio02" name="bank_type" 
						<?php echo set_radio('bank_type', 1, $checked_2); ?>  value="1"/><label class="radio" for="radio02">当座預金</label>
					<span style="color:red"><?php echo form_error('bank_type'); ?></span>
					<div id="bank_type"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>口座番号<span class="must">※</span></th>
					<td>
					<?php
						$class_error_bank_number = !empty(form_error('bank_number')) ? "error" : "";
					?>
					<input type="tel" name="bank_number" maxlength="20" value="<?php echo !empty($company_info->bank_number) ? $company_info->bank_number : set_value('bank_number'); ?>" placeholder="" class="<?=$class_error_bank_number; ?>">
					<span style="color:red"><?php echo form_error('bank_number'); ?></span>
					<div id="bank_number"></div>
					</td>
				 </tr>
				 <tr>
				 	<th>口座名義人<span class="must">※</span></th>
					<td>
					<?php
						$class_error_bank_holder = !empty(form_error('bank_holder')) ? "error" : "";
					?>
					<input type="text" name="bank_holder" maxlength="50" value="<?php echo !empty($company_info->bank_holder) ? $company_info->bank_holder : set_value('bank_holder'); ?>" placeholder="" class="<?=$class_error_bank_holder; ?>">
					<span style="color:red"><?php echo form_error('bank_holder'); ?></span>
					<div id="bank_holder"></div>
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
	<footer id="footer">
		<div class="footerCopy">
			<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
		</div>
	</footer>
	<!--▲▲▲footer▲▲▲-->
</div>
<!--▲▲▲main▲▲▲-->
