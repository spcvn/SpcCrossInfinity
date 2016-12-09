<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
		
		<!-- #BeginLibraryItem "/Library/ユーザーメニュー.lbi" -->

		<?php $this->view('frontend/layout/_user_menu'); ?>
		<!-- #EndLibraryItem -->		
		</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form action="" method="POST" id="form_registration" novalidate>
				<h2 class="user">マイページ編集(ユーザー)</h2>
				
				 <table class="form">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員名<span class="must">※</span></th>
						<td>
						<?php 
							$name = !empty($user['name']) ? $user['name'] : set_value('name');
							$class_error_name = !empty(form_error('name')) ? "error" : "";
						?>
						<input type="text" name="name" value="<?php echo $name; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_name; ?>" >
						<?php echo '<span class="error">'.form_error('name').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th>ふりがな<span class="must">※</span></th>
						<td>
						<?php 
							$name_kana = !empty($user['name_kana']) ? $user['name_kana'] : set_value('name_kana');
							$class_error_name_kana = !empty(form_error('name_kana')) ? "error" : "";
						?>
						<input type="text" name="name_kana" value="<?php echo $name_kana; ?>" placeholder="" maxlength="100" class="<?php echo $class_error_name_kana; ?>" >
						<?php echo '<span class="error">'.form_error('name_kana').'</span>' ?>
						</td>
					 </tr>
					 <tr>
						<th>郵便番号<span class="must">※</span></th>
						<td>
						<?php
							$post_code = preg_split ('/-/',$user['post_code'] );
							$post_code_left = isset($post_code[0]) ? $post_code[0] : set_value('post_code_left');
							$post_code_right = isset($post_code[1]) ? $post_code[1] : set_value('post_code_right');
							$post_code_error = strlen(form_error('post_code_left')) > 0 ? form_error('post_code_left') : form_error('post_code_right');
							$class_error_post_code_left = strlen(form_error('post_code_left')) > 0 ? "error" : "";
							$class_error_post_code_right = strlen(form_error('post_code_right')) >0 ? "error" : "";
						?>
						〒 <input type="tel" name="post_code_left" value="<?php echo $post_code_left; ?>" placeholder="" class="w50 <?php echo $class_error_post_code_left; ?>" maxlength="3">
						-
						<input type="tel" name="post_code_right" value="<?php echo $post_code_right; ?>" placeholder="" class="w50 <?php echo $class_error_post_code_right; ?>" maxlength="4">
						<?php echo '<span class="error">'.$post_code_error.'</span>' ?>
						
						<div id="post_code_left"></div>
						<div id="post_code_right"></div>
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
											$selected = !empty($user['prefecture_id']) && $user['prefecture_id'] == $item->prefecture_id ? "selected" : 
														(!empty(set_value('prefecture')) && set_value('prefecture') == $item->prefecture_id ? "selected" : "");
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
							$city = isset($user['city']) ? $user['city'] : set_value('city');
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
							$tel = preg_split ('/-/',$user['tel'] );
							$tel_left = isset($tel[0]) ? $tel[0] : set_value('tel_left');
						 	$tel_center = isset($tel[1]) ? $tel[1] : set_value('tel_center');
							$tel_right = isset($tel[2]) ? $tel[2] : set_value('tel_right');

							$tel_error = "";
							if(strlen(form_error('tel_left')) > 0){
								$tel_error = form_error('tel_left');
							}
							else{
								if(strlen(form_error('tel_center')) > 0 ){
									$tel_error = form_error('tel_center');
								}
								else{
									$tel_error = form_error('tel_right');
								}
							}

							$class_error_tel_left = strlen(form_error('tel_left')) > 0 ? "error" : "";
							$class_error_tel_center = strlen(form_error('tel_center')) > 0  ? "error" : "";
							$class_error_tel_right = strlen(form_error('tel_right')) > 0  ? "error" : "";
						?>
						<input type="tel" name="tel_left" value="<?php echo $tel_left; ?>" placeholder="" class="w50 <?php echo $class_error_tel_left; ?>" maxlength="5">
						-
						<input type="tel" name="tel_center" value="<?php echo $tel_center; ?>" placeholder="" class="w50 <?php echo $class_error_tel_center; ?>" maxlength="5">
						-
						<input type="tel" name="tel_right" value="<?php echo $tel_right; ?>" placeholder="" class="w50 <?php echo $class_error_tel_right; ?>" maxlength="5">
						<?php echo '<span class="error">'.$tel_error.'</span>' ?>
						<div id="tel_left"></div>
						<div id="tel_center"></div>
						<div id="tel_right"></div>
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<?php
							$mail = !empty($user['mail']) ? $user['mail'] : set_value('mail');
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
							$introducer_name = NULL;
							$introduce_uid  = NULL;
							if(isset($user['introduce_uid']) && empty($user['introducer_name'])){
								$introducer =  $this->User_model->get_user($user['introduce_uid']);
								if($introducer != false){
									$introduce_uid = $introducer['uid_name'];
									$introducer_name= $introducer['name'];
								}
							}
							if(isset($user['introducer_name'])){
								$introduce_uid = $user['introducer_name'];
							}
							$class_error_introducer = !empty(form_error('introducer_name')) ? "error" : "";
						?>
						<input type="text" name="introduce_uid" value="<?php echo $introduce_uid; ?>" placeholder="" maxlength="12" class="<?php echo $class_error_introducer; ?>">
						<input type="hidden" name="introduce_uid_name" value="<?php echo $introduce_uid; ?>">
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
							$company_name = isset($user['company_name']) ? $user['company_name'] : set_value('company_name');
							$class_error_company_name = !empty(form_error('company_name')) ? "error" : "";
						?>
						<input type="text" name="company_name" value="<?php echo $company_name; ?>" placeholder="" maxlength="50" class="<?php echo $class_error_company_name; ?>">
						<?php echo '<span class="error">'.form_error('company_name').'</span>' ?>
						</td>
						</td>
					 </tr>
					 <tr>
					 	<th>法人住所</th>
						<td>
						<?php
							$company_address = isset($user['company_address']) ? $user['company_address'] : set_value('company_address');
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
							$company_tel = preg_split ('/-/',$user['company_tel'] );
							$company_tel_left = isset($company_tel[0]) ? $company_tel[0] : set_value('company_tel_left');
							$company_tel_center = isset($company_tel[1]) ? $company_tel[1] : set_value('company_tel_center');
							$company_tel_right = isset($company_tel[2]) ? $company_tel[2] : set_value('company_tel_right');
							$class_error_company_tel_left = strlen(form_error('company_tel_left')) > 0 ? "error" : "";
							$class_error_company_tel_center = strlen(form_error('company_tel_center')) > 0 ? "error" : "";
							$class_error_company_tel_right = strlen(form_error('company_tel_right')) > 0 ? "error" : "";
							$company_tel_error = "";
							if(strlen(form_error('company_tel_left')) > 0){
								$company_tel_error = form_error('company_tel_left');
							}
							else{
								if(strlen(form_error('company_tel_center')) > 0 ){
									$company_tel_error = form_error('company_tel_center');
								}
								else{
									$company_tel_error = form_error('company_tel_right');
								}
							}
							?>
						<input type="tel" name="company_tel_left" value="<?php echo $company_tel_left; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_left; ?>" maxlength="5">
						-
						<input type="tel" name="company_tel_center" value="<?php echo $company_tel_center; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_center; ?>" maxlength="5">
						-
						<input type="tel" name="company_tel_right" value="<?php echo $company_tel_right; ?>" placeholder="" class="w50 <?php echo $class_error_company_tel_right; ?>" maxlength="5">
						<?php echo '<span class="error">'.$company_tel_error.'</span>' ?>
						<div id="company_tel_left"></div>
						<div id="company_tel_center"></div>
						<div id="company_tel_right"></div>
						</td>
					 </tr>
						<th class="h3" colspan="2"><h3 id="change-password">パスワード</h3></th>
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
							$password_login_edit = set_value('password_login');
							$class_error_password_login = !empty(form_error('password_login')) ? "error" : "";
							$password_login = "";
							for ($i=0; $i < $user['password_login_length']; $i++) { 
								$password_login .= "●";
							}
						?>
						<input type="password"  name="password_login"  id="password_login" value="<?php echo $password_login_edit; ?>" placeholder="<?php echo $password_login ?>" maxlength="50" class="<?php echo $class_error_password_login; ?>">
						<input type="hidden" name="password_login_length" value="<?php echo $user['password_login_length']; ?>">
						<span class="att">(半角英数字記号8文字以上)</span>
						<?php echo '<span class="error">'.form_error('password_login').'</span>' ?>
						</td>
					 </tr>
					 <tr>
					 	<th>ポイント使用<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$password_point = "";
							for ($i=0; $i < $user['password_point_length']; $i++) { 
								$password_point .= "●";
							}
							$password_point_edit = set_value('password_point');
							$class_error_password_point = !empty(form_error('password_point_edit')) ? "error" : "";
						?>
						<input type="password" name="password_point" id="password_point" value="<?php echo $password_point_edit; ?>" placeholder="<?php echo $password_point ?>" maxlength="50" class="<?php echo $class_error_password_point; ?>">
						<input type="hidden" name="password_point_length" value="<?php echo $user['password_point_length'] ?>">
						<span class="att">(半角英数字記号8文字以上)</span>
						<?php echo '<span class="error">'.form_error('password_point').'</span>' ?>
						</td>
					 </tr>
					 
				 </tbody>
				 </table>
				 <p class="btn_submit"><button type="submit" class="submit" name="submit" id="update">登録</button></p>
				 <p class="btn gray"><a href="<?php echo base_url('user/detail') ?>">戻る</a></p>
				 
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