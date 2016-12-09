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
			<form id = "editForm1" action="<?php echo base_url('company/support-empty'); ?>" method="post">
				<input type="hidden" name="active_flag" id="active_flag" value="0">
				<input type="hidden" name="form_has_data" value='0' id="form_has_data"> 
				<h2 class="kigyou">応援条件編集</h2>
				
				 <table class="form edit">
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
							<select name="reward_group" onchange="restoreSupport1()" class="<?=$class_error_reward_group; ?>">
								<option value="1" <?php echo set_select('reward_group',  1); ?>>通常応援</option>
								<option value="2" <?php echo set_select('reward_group',  2); ?>>応援不要企業寄付</option>
								<option value="3" <?php echo set_select('reward_group',  3); ?>>寄付</option>
							</select>
							<span style="color:red" class="php-error"><?php echo form_error('reward_group'); ?></span>
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
							<input type="date" onchange="restoreSupport1()" id ="fromDate" name="reward_from_data" value="<?php echo set_value('reward_from_data'); ?>" placeholder="" class="<?=$class_error_reward_from_data; ?>">
							<span style="color:red" class="php-error"><?php echo form_error('reward_from_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象年月日<br>To</th>
						<td>
							<?php
								$class_error_reward_to_data = !empty(form_error('reward_to_data')) ? "error" : "";
							?>
							<input type="date" onchange="restoreSupport1()" id="toDate" name="reward_to_data" value="<?php echo set_value('reward_to_data'); ?>" placeholder="" class="<?=$class_error_reward_to_data; ?>">
							<span style="color:red" class="php-error"><?php echo form_error('reward_to_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>From<span class="must">※</span></th>
						<td>
							<?php
								$class_error_reward_from_time = !empty(form_error('reward_from_time')) ? "error" : "";
							?>
							<input type="time" onchange="restoreSupport1()" id ="fromTime" name="reward_from_time" value="<?php echo set_value('reward_from_time'); ?>" placeholder="" class="<?=$class_error_reward_from_time; ?>">
							<span style="color:red" class="php-error"><?php echo form_error('reward_from_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>To</th>
						<td>
							<?php
								$class_error_reward_to_time = !empty(form_error('reward_to_time')) ? "error" : "";
							?>
							<input type="time" onchange="restoreSupport1()" id ="toTime" name="reward_to_time" value="<?php echo set_value('reward_to_time'); ?>" placeholder="" class="<?=$class_error_reward_to_time; ?>">
							<span style="color:red" class="php-error"><?php echo form_error('reward_to_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th><span style="font-size:11px">応援適用最低金額<span class="must">※</span></span></th>
						<td>
						<?php
							$class_error_applied_lowest_price = !empty(form_error('applied_lowest_price')) ? "error" : "";
						?>
						<input type="tel" id="lowest_price" onchange="restoreSupport1()" name="applied_lowest_price" maxlength="20" value="<?php echo set_value('applied_lowest_price'); ?>" placeholder="" class="w150 <?=$class_error_applied_lowest_price; ?>"> 円
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
						<input type="tel" onchange="restoreSupport1()" id ="discount_price" min="0" maxlength="20" name="discount_price" value="<?php echo set_value('discount_price'); ?>" placeholder="" class="w50 <?=$class_error_discount_price; ?>">
						円　or
						<div class="select_box w65">
						<select name="discount_rate" onchange="restoreSupport1()" id ="discount_rate" class="<?=$class_error_discount_rate; ?>">
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
						<input type="tel" onchange="restoreSupport1()" id ="reward_point" min="0" maxlength="20" name="reward_point" value="<?php echo set_value('reward_point'); ?>" placeholder="" class="w50 <?=$class_error_reward_point; ?>">
						円　or
						<div class="select_box w65">
						<select name="reward_point_rate" onchange="restoreSupport1()" id ="reward_point_rate" class="<?=$class_error_reward_point_rate; ?>">
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
					 	<th style="padding: 55px 0 0 8px;">応援内容説明<span class="must">※</span></th>
						<td>
						<?php
							$class_error_reward_content = !empty(form_error('reward_content')) ? "error" : "";
						?>	
						<textarea cols="30" id="reward_content" onchange="restoreSupport1()" rows="4" name="reward_content" maxlength="2000" placeholder="MAX2,000文字" class="<?=$class_error_reward_content; ?>"><?php echo set_value('reward_content');?></textarea>
						<span style="color:red" class="php-error"><?php echo form_error('reward_content'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
				 </tbody>

				</table>
				 
				 <table class="form form-support2">
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
							
							<div class="select_box">
							<select name="tmp_reward_group" onchange="checkFormHasData(this.value)">
								<option value="1" <?php echo set_select('tmp_reward_group',  1); ?>>通常応援</option>
								<option value="2" <?php echo set_select('tmp_reward_group',  2); ?>>応援不要企業寄付</option>
								<option value="3" <?php echo set_select('tmp_reward_group',  3); ?>>寄付</option>
							</select>
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_group'); ?></span>
							<div class="error-js"></div>
							</div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px" >応援対象年月日<br>From<span class="must">※</span></th>
						<td>
							
							<input type="date" onchange="checkFormHasData(this.value)" id ="tmp_fromDate" name="tmp_reward_from_data" value="<?php echo set_value('tmp_reward_from_data'); ?>" placeholder="">
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_from_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象年月日<br>To</th>
						<td>
							
							<input type="date" onchange="checkFormHasData(this.value)" id="tmp_toDate" name="tmp_reward_to_data" value="<?php echo set_value('tmp_reward_to_data'); ?>" placeholder="">
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_to_data'); ?></span>
							<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>From<span class="must">※</span></th>
						<td>
						
							<input type="time" onchange="checkFormHasData(this.value)" id ="tmp_fromTime" name="tmp_reward_from_time" value="<?php echo set_value('tmp_reward_from_time'); ?>" placeholder="">
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_from_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
						<th style="padding:10px 0 0 8px">応援対象時間<br>To</th>
						<td>
							<input type="time" onchange="checkFormHasData(this.value)" id ="tmp_toTime" name="tmp_reward_to_time" value="<?php echo set_value('tmp_reward_to_time'); ?>" placeholder="">
							<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_to_time'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th><span style="font-size:11px">応援適用最低金額<span class="must">※</span></span></th>
						<td>
						<input type="tel" onchange="checkFormHasData(this.value)" class="w150" id="tmp_Tel" name="tmp_applied_lowest_price" maxlength="20" value="<?php echo set_value('tmp_applied_lowest_price'); ?>" placeholder=""> 円
						<span style="color:red" class="php-error"><?php echo form_error('tmp_applied_lowest_price'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>購入者割引<span class="must">※</span></th>
						<td>	
						<input type="tel" onchange="checkFormHasData(this.value)" id ="tmp_discount_price" min="0" maxlength="20" name="tmp_discount_price" value="<?php echo set_value('tmp_discount_price'); ?>" placeholder="" class="w50">
						円　or
						<div class="select_box w65">
						<select onchange="checkFormHasData(this.value)" name="tmp_discount_rate" id ="tmp_discount_rate">
							<option value=""></option>
							<option value="1" <?php echo set_select('tmp_discount_rate',  1); ?>>1</option>
							<option value="2" <?php echo set_select('tmp_discount_rate',  2); ?>>2</option>
							<option value="3" <?php echo set_select('tmp_discount_rate',  3); ?>>3</option>
							<option value="4" <?php echo set_select('tmp_discount_rate',  4); ?>>4</option>
							<option value="5" <?php echo set_select('tmp_discount_rate',  5); ?>>5</option>
							<option value="6" <?php echo set_select('tmp_discount_rate',  6); ?>>6</option>
							<option value="7" <?php echo set_select('tmp_discount_rate',  7); ?>>7</option>
							<option value="8" <?php echo set_select('tmp_discount_rate',  8); ?>>8</option>
							<option value="9" <?php echo set_select('tmp_discount_rate',  9); ?>>9</option>
							<option value="10" <?php echo set_select('tmp_discount_rate',  10); ?>>10</option>
							<option value="15" <?php echo set_select('tmp_discount_rate',  15); ?>>15</option>
							<option value="20" <?php echo set_select('tmp_discount_rate',  20); ?>>20</option>
						</select>
						</div>
						&#37;
						<span style="color:red" class="php-error">
							<?php echo form_error('tmp_discount_rate'); ?>	
						</span>	
						<div id="discount"></div>
						</td>
					 </tr>
					 <tr>
					 	<th>販売促進費<span class="must">※</span></th>
						<td>	
						<input type="tel" onchange="checkFormHasData(this.value)" id ="tmp_reward_point" min="0" maxlength="20" name="tmp_reward_point" value="<?php echo set_value('tmp_reward_point'); ?>" placeholder="" class="w50">
						円　or
						<div class="select_box w65">
						<select onchange="checkFormHasData(this.value)" name="tmp_reward_point_rate" id ="tmp_reward_point_rate">
							<option value=""></option>
							<option value="1" <?php echo set_select('tmp_reward_point_rate',  1); ?>>1</option>
							<option value="2" <?php echo set_select('tmp_reward_point_rate',  2); ?>>2</option>
							<option value="3" <?php echo set_select('tmp_reward_point_rate',  3); ?>>3</option>
							<option value="4" <?php echo set_select('tmp_reward_point_rate',  4); ?>>4</option>
							<option value="5" <?php echo set_select('tmp_reward_point_rate',  5); ?>>5</option>
							<option value="10" <?php echo set_select('tmp_reward_point_rate',  10); ?>>10</option>
							<option value="15" <?php echo set_select('tmp_reward_point_rate',  15); ?>>15</option>
							<option value="20" <?php echo set_select('tmp_reward_point_rate',  20); ?>>20</option>
							<option value="25" <?php echo set_select('tmp_reward_point_rate',  25); ?>>25</option>
							<option value="30" <?php echo set_select('tmp_reward_point_rate',  30); ?>>30</option>
							<option value="35" <?php echo set_select('tmp_reward_point_rate',  35); ?>>35</option>
							<option value="40" <?php echo set_select('tmp_reward_point_rate',  40); ?>>40</option>
							<option value="45" <?php echo set_select('tmp_reward_point_rate',  45); ?>>45</option>
							<option value="50" <?php echo set_select('tmp_reward_point_rate',  50); ?>>50</option>
						</select>
						</div>
						&#37;
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_point_rate'); ?></span>
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
						<textarea cols="30" onchange="checkFormHasData(this.value)" rows="4" id="tmp_reward_content" name="tmp_reward_content" maxlength="2000" placeholder="MAX2,000文字"><?php echo set_value('tmp_reward_content');?></textarea>
						<span style="color:red" class="php-error"><?php echo form_error('tmp_reward_content'); ?></span>
						<div class="error-js"></div>
						</td>
					 </tr>
					  <tr>
						<th class="h3" colspan="2"><h3>メールアドレス</h3></th>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<input onchange="renameSupport1()" type="email" name="mail" maxlength="255" value="<?php echo !empty($company_info->mail) ? $company_info->mail : set_value('mail'); ?>" placeholder="">
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
						<input onchange="renameSupport1()" type="password" name="password_login" value="<?php echo set_value('password_login'); ?>" placeholder="<?php echo $password_login; ?>" class="<?=$class_error_password_login; ?>">
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
						<input onchange="renameSupport1()" type="password" name="password_reward" value="<?php echo set_value('password_reward'); ?>" placeholder="<?php echo $password_reward; ?>" class="<?=$class_error_password_reward; ?>">
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
	<!--▼▼▼footer▼▼▼-->
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