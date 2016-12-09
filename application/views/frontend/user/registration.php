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
			<form action="" method="POST" id="form_registration" novalidate>
				<h2 class="user">ユーザー登録</h2>
				
				 <table class="form">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員名<span class="must">※</span></th>
						<td>
						<?php
							$name = isset($data_form['name']) ? $data_form['name'] : set_value('name');
							$class_error_name = !empty(form_error('name')) ? "error" : "";
						?>
						<input type="text" name="name" value="<?php echo $name; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_name; ?>">
						<?php echo '<span class="error">'.form_error('name').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th>ふりがな<span class="must">※</span></th>
						<td>
						<?php 
							$name_kana = isset($data_form['name_kana']) ? $data_form['name_kana'] : set_value('name_kana');
							$class_error_name_kana = !empty(form_error('name_kana')) ? "error" : "";
						?>
						<input type="text" name="name_kana" value="<?php echo $name_kana; ?>" placeholder="" maxlength="100" class="<?php echo $class_error_name_kana; ?>">
						<?php echo '<span class="error">'.form_error('name_kana').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th>郵便番号<span class="must">※</span></th>
						<td>
						〒 
						<?php
							$post_code_left = isset($data_form['post_code_left']) ? $data_form['post_code_left'] : set_value('post_code_left');
							$post_code_right = isset($data_form['post_code_right']) ? $data_form['post_code_right'] : set_value('post_code_right');
							$post_code = strlen(form_error('post_code_left')) > 0 ? form_error('post_code_left') : form_error('post_code_right');
							$class_error_post_code_left = strlen(form_error('post_code_left')) > 0 ? "error" : "";
							$class_error_post_code_right = strlen(form_error('post_code_right')) >0 ? "error" : "";
							?>
						<input type="tel" name="post_code_left" value="<?php echo $post_code_left; ?>" placeholder="" class="w50 <?php echo $class_error_post_code_left; ?>" maxlength="3">
						-
						<input type="tel" name="post_code_right" value="<?php echo $post_code_right; ?>" placeholder="" class="w50 <?php echo $class_error_post_code_right; ?>" maxlength="4">
						<?php echo '<span class="error">'.$post_code.'</span>' ?>
						
						<div id="post_code"></div>
						</td>
					 </tr>
					 <tr>
						<th>都道府県<span class="must">※</span></th>
						<td>
							<div class="select_box">
							<?php
								$class_error_prefecture = !empty(form_error('prefecture')) ? "error" : "";
							?>
							<select name="prefecture" class="<?php echo $class_error_prefecture; ?>">
								<option  value="" ></option>
								<?php
									if($prefecture != false){
										$selected = "";

										foreach ($prefecture as $item) {
											$selected = (isset($data_form['prefecture_id']) && $data_form['prefecture_id'] == $item->prefecture_id) ? 
											"selected" : ((!empty(set_value('prefecture')) &&  set_value('prefecture') == $item->prefecture_id) ? "selected" : "");
								?>
								<option value="<?php echo $item->prefecture_id; ?>" <?php echo $selected; ?> ><?php echo $item->prefecture_name; ?></option>
								<?php } } ?>
							</select>
							<?php echo '<span class="error">'.form_error('prefecture').'</span>' ?>
							</div>
						</td>
					 </tr>
					 <tr>
						<th>市区町村<span class="must">※</span></th>
						<td>
						<?php
							$city = isset($data_form['city']) ? $data_form['city'] : set_value('city');
							$class_error_city = !empty(form_error('city')) ? "error" : "";
						?>
						<input type="text" name="city" value="<?php echo $city; ?>" placeholder="" maxlength="30" class="<?php echo $class_error_city; ?>">
						<?php echo '<span class="error">'.form_error('city').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th>連絡先<span class="must">※</span></th>
						<td>
						<?php
							$tel_left = isset($data_form['tel_left']) ? $data_form['tel_left'] : set_value('tel_left');
							$tel_center = isset($data_form['tel_center']) ? $data_form['tel_center'] : set_value('tel_center');
							$tel_right = isset($data_form['tel_right']) ? $data_form['tel_right'] : set_value('tel_right');

							$tel = "";
							if(strlen(form_error('tel_left')) > 0){
								$tel = form_error('tel_left');
							}
							else{
								if(strlen(form_error('tel_center')) > 0 ){
									$tel = form_error('tel_center');
								}
								else{
									$tel = form_error('tel_right');
								}
							}

							$class_error_tel_left = strlen(form_error('tel_left')) > 0 ? "error" : "";
							$class_error_tel_center = strlen(form_error('tel_center')) > 0  ? "error" : "";
							$class_error_tel_right = strlen(form_error('tel_right')) > 0  ? "error" : "";
						?>
						<input type="tel" name="tel_left" value="<?php echo $tel_left; ?>" placeholder="" class="w50 <?php echo $class_error_tel_left; ?>" maxlength="4">
						-
						<input type="tel" name="tel_center" value="<?php echo $tel_center; ?>" placeholder="" class="w50 <?php echo $class_error_tel_center; ?>" maxlength="4">
						-
						<input type="tel" name="tel_right" value="<?php echo $tel_right; ?>" placeholder="" class="w50 <?php echo $class_error_tel_right; ?>" maxlength="4">
						<?php echo '<span class="error">'.$tel.'</span>' ?>
						<div id="tel_left"></div>
						<div id="tel_center"></div>
						<div id="tel_right"></div>
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<?php
							$mail = isset($data_form['mail']) ? $data_form['mail'] : set_value('mail');
							$class_error_mail = !empty(form_error('mail')) ? "error" : "";
						?>
						<input type="email" name="mail" value="<?php echo $mail; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_mail; ?>">
						<?php echo '<span class="error">'.form_error('mail').'</span>' ?>
						</td>
					 </tr>
					 
					 <tr>
					 	<th>紹介者ID</th>
						<td>
						<?php
							$introduce_uid = isset($data_form['introduce_uid']) ? $data_form['introduce_uid'] : set_value('introduce_uid');
							$class_error_introducer = !empty(form_error('introduce_uid')) ? "error" : "";
						?>
						<input type="text" name="introduce_uid" value="<?php echo $introduce_uid; ?>" placeholder="" maxlength="12" class="<?php echo $class_error_introducer; ?>">
						<?php echo '<span class="error">'.form_error('introduce_uid').'</span>' ?>
						</td>
					 </tr>
					 <tr>
					 	<th>&nbsp;</th>
						<td class="txt tdkome">
						<p class="kome">※紹介者がいる場合、記入してください。</p>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>法人様アカウント情報</h3><span class="att">※任意</span></th>
					 </tr>
					 <tr>
					 	<th>法人名</th>
						<td>
						<?php
							$company_name = isset($data_form['company_name']) ? $data_form['company_name'] : set_value('company_name');
							$class_error_company_name = !empty(form_error('company_name')) ? "error" : "";
						?>
						<input type="text" name="company_name" value="<?php echo $company_name; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_company_name; ?>">
						<?php echo '<span class="error">'.form_error('company_name').'</span>' ?>
						</td>
					 </tr>
					 <tr>
					 	<th>法人住所</th>
						<td>
						<?php
							$company_address = isset($data_form['company_address']) ? $data_form['company_address'] : set_value('company_address');
							$class_error_company_address = !empty(form_error('company_address')) ? "error" : "";
						?>
						<input type="text" name="company_address" value="<?php echo $company_address; ?>" placeholder="" maxlength="255" class="<?php echo $class_error_company_address; ?>">
						<?php echo '<span class="error">'.form_error('company_address').'</span>' ?>
						</td>
					 </tr>
					 <tr>
					 	<th>法人連絡先</th>
						<td>
						<?php 
							$company_tel_left = isset($data_form['company_tel_left']) ? $data_form['company_tel_left'] : set_value('company_tel_left');
							$company_tel_center = isset($data_form['company_tel_center']) ? $data_form['company_tel_center'] : set_value('company_tel_center');
							$company_tel_right = isset($data_form['company_tel_right']) ? $data_form['company_tel_right'] : set_value('company_tel_right');
							$class_error_company_tel_left = strlen(form_error('company_tel_left')) > 0 ? "error" : "";
							$class_error_company_tel_center = strlen(form_error('company_tel_center')) > 0 ? "error" : "";
							$class_error_company_tel_right = strlen(form_error('company_tel_right')) > 0 ? "error" : "";
							$company_tel = "";
							if(strlen(form_error('company_tel_left')) > 0){
								$company_tel = form_error('company_tel_left');
							}
							else{
								if(strlen(form_error('company_tel_center')) > 0 ){
									$company_tel = form_error('company_tel_center');
								}
								else{
									$company_tel = form_error('company_tel_right');
								}
							}
							?>
						<input type="tel" name="company_tel_left" value="<?php echo $company_tel_left; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_left; ?>" maxlength="4">
						-
						<input type="tel" name="company_tel_center" value="<?php echo $company_tel_center; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_center; ?>" maxlength="4">
						-
						<input type="tel" name="company_tel_right" value="<?php echo $company_tel_right; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_right; ?>" maxlength="4">
						<?php echo '<span class="error">'.$company_tel.'</span>' ?>
						<div id="company_tel_left"></div>
						<div id="company_tel_center"></div>
						<div id="company_tel_right"></div>
						</td>
					 </tr>
						<th class="h3" colspan="2"><h3>パスワード</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
						<p class="kome">※ポイント使用パスワードとログインパスワードは<br>同じものは使用不可</p>
						</td>
					 </tr>
					 <tr>
					 	<th>ログイン<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$password_login = isset($data_form['password_login']) ? $data_form['password_login'] : set_value('password_login');
							$class_error_password_login = !empty(form_error('password_login')) ? "error" : "";
						?>
						<input type="password" name="password_login" required id="password_login" value="<?php echo $password_login; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_password_login; ?>">
						<span class="att">(半角英数字記号8文字以上)</span>
						<?php echo '<span class="error">'.form_error('password_login').'</span>' ?>
						</td>
					 </tr>
					 <tr>
					 	<th>ポイント使用<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$password_point = isset($data_form['password_point']) ? $data_form['password_point'] : set_value('password_point');
							$class_error_password_point = !empty(form_error('password_point')) ? "error" : "";
						?>
						<input type="password" name="password_point" required id="password_point" value="<?php echo $password_point; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_password_point; ?>">
						<span class="att">(半角英数字記号8文字以上)</span>
						<?php echo '<span class="error">'.form_error('password_point').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>利用規約</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
							<div class="note">
								<a href="<?php echo base_url('assets/pdf/CROSS INFINITY 会員利用規約.pdf');?>" target="_blank">利用規約PDF</a><br>
								<input type="checkbox" id="checkbox" name="accept" <?php echo !empty(set_value('accept')) ? "checked" : ""; ?>/>
								<label class="check" for="checkbox">上記内容に同意する</label>
							</div>
							<div id="accept-messege">
								<?php echo '<span class="error">'.form_error('accept').'</span>' ?>
							</div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn_submit"><button type="submit" class="submit" name="submit" id="registration">確認</button></p>
				 <p class="btn gray"><a href="<?php echo base_url('login'); ?>">戻る</a></p>
				 
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