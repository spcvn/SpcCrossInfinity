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
			<form action="<?php echo base_url('user/confirm') ?>" method="POST" id="form_confirm" novalidate>
				<h2 class="user">ユーザー登録 - 確認</h2>
				
				 <table class="form confirm">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員名<span class="must">※</span></th>
						<td>
						<?php echo $data_form['name']; ?>
						<input type="hidden" name="name" value="<?php echo $data_form['name']; ?>">
						</td>
					 </tr>
					 <tr>
						<th>ふりがな<span class="must">※</span></th>
						<td>
						<?php echo $data_form['name_kana']; ?>
						<input type="hidden" name="name_kana" value="<?php echo $data_form['name_kana']; ?>">
						</td>
					 </tr>
					 <tr>
						<th>郵便番号<span class="must">※</span></th>
						<td>
						〒 <?php echo $data_form['post_code_left']."-".$data_form['post_code_right']; ?>
						<input type="hidden" name="post_code_left" value="<?php echo $data_form['post_code_left']; ?>">
						<input type="hidden" name="post_code_right" value="<?php echo $data_form['post_code_right']; ?>">
						</td>
					 </tr>
					 <tr>
						<th>都道府県<span class="must">※</span></th>
						<td>
							<?php  echo $this->Prefecture_model->get_item_prefecture($data_form['prefecture_id'])['prefecture_name']; ?>
							<input type="hidden" name="prefecture_id" value="<?php echo $data_form['prefecture_id']; ?>">						</td>
					 </tr>
					 <tr>
						<th>市区町村<span class="must">※</span></th>
						<td>
							<?php  echo $data_form['city']; ?>
							<input type="hidden" name="city" value="<?php echo $data_form['city']; ?>">
							
						</td>
					 </tr>
					 <tr>
						<th>連絡先<span class="must">※</span></th>
						<td>
							<?php  echo $data_form['tel_left']."-".$data_form['tel_center']."-".$data_form['tel_right']; ?>
							<input type="hidden" name="tel_left" value="<?php echo $data_form['tel_left']; ?>">
							<input type="hidden" name="tel_center" value="<?php echo $data_form['tel_center']; ?>">
							<input type="hidden" name="tel_right" value="<?php echo $data_form['tel_right']; ?>">
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
							<?php  echo $data_form['mail']; ?>
							<input type="hidden" name="mail" value="<?php echo $data_form['mail']; ?>">
						</td>
					 </tr>
					 <tr>
						<td colspan="2" class="txt b0">
						<!-- ※紹介者がいる場合、記入してください。 -->
						</td>
					 </tr>
					 <tr>
					 	<th>紹介者ID</th>
						<td>
							<?php
								// $introduce_uid =  $this->User_model->get_user_by_uid_name($data_form['introduce_uid']);
								// $introducer_name = NULL;
								// $uid = "";
								// if($introduce_uid != false){
								// 	$introducer_name = $introduce_uid['name'];
								// 	$uid = $data_form['introduce_uid'];
								// }
							?>
							<?php  echo $data_form['introduce_uid']; ?>
							<input type="hidden" name="introduce_uid" value="<?php echo $data_form['introduce_uid']; ?>">
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>法人様アカウント情報</h3><span class="att">※任意</span></th>
					 </tr>
					 <tr>
					 	<th>法人名</th>
						<td>
							<?php  echo $data_form['company_name']; ?>
							<input type="hidden" name="company_name" value="<?php echo $data_form['company_name']; ?>">
						</td>
					 </tr>
					 <tr>
					 	<th>法人住所</th>
						<td>
							<?php  echo $data_form['company_address']; ?>
							<input type="hidden" name="company_address" value="<?php echo $data_form['company_address']; ?>">
						</td>
					 </tr>
					 <tr>
					 	<th>法人連絡先</th>
						<td>
							<?php  
							$company_tel = "";
							if($data_form['company_tel_left'] != "" && 
								$data_form['company_tel_center'] != "" &&
								$data_form['company_tel_right'] != ""){
								$company_tel = $data_form['company_tel_left']."-".$data_form['company_tel_center']."-".$data_form['company_tel_right'];
							}
							echo $company_tel; ?>
							<input type="hidden" name="company_tel_left" value="<?php echo $data_form['company_tel_left']; ?>">
							<input type="hidden" name="company_tel_center" value="<?php echo $data_form['company_tel_center']; ?>">
							<input type="hidden" name="company_tel_right" value="<?php echo $data_form['company_tel_right']; ?>">
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
							$str1 = "";
							for ($i=0; $i < strlen($data_form['password_login']); $i++) { 
								$str1 .="＊";
							}
							echo $str1; ?>
							<input type="hidden" name="password_login" value="<?php echo $data_form['password_login']; ?>">
						</td>
					 </tr>
					 <tr>
					 	<th>ポイント使用<br>パスワード<span class="must">※</span></th>
						<td>
						<!-- ＊＊＊＊＊＊＊＊ -->
							<?php 
							$str = "";
							for ($i=0; $i < strlen($data_form['password_point']); $i++) { 
								$str .="＊";
							}
							echo $str; ?>
							<input type="hidden" name="password_point" value="<?php echo $data_form['password_point']; ?>">
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn_submit"><button type="submit" class="submit" name="confirm">登録</button></p>
			</form>
			<form action="<?php echo base_url('user/registration') ?>" method="POST" id="form_confirm">
				<input type="hidden" name="name" value="<?php echo $data_form['name']; ?>">
				<input type="hidden" name="name_kana" value="<?php echo $data_form['name_kana']; ?>">
				<input type="hidden" name="post_code_left" value="<?php echo $data_form['post_code_left']; ?>">
				<input type="hidden" name="post_code_right" value="<?php echo $data_form['post_code_right']; ?>">
				<input type="hidden" name="prefecture_id" value="<?php echo $data_form['prefecture_id']; ?>">
				<input type="hidden" name="city" value="<?php echo $data_form['city']; ?>">
				<input type="hidden" name="tel_left" value="<?php echo $data_form['tel_left']; ?>">
				<input type="hidden" name="tel_center" value="<?php echo $data_form['tel_center']; ?>">
				<input type="hidden" name="tel_right" value="<?php echo $data_form['tel_right']; ?>">
				<input type="hidden" name="mail" value="<?php echo $data_form['mail']; ?>">
				<input type="hidden" name="introduce_uid" value="<?php echo $data_form['introduce_uid']; ?>">
				<input type="hidden" name="company_name" value="<?php echo $data_form['company_name']; ?>">
				<input type="hidden" name="company_address" value="<?php echo $data_form['company_address']; ?>">
				<input type="hidden" name="company_tel_left" value="<?php echo $data_form['company_tel_left']; ?>">
				<input type="hidden" name="company_tel_center" value="<?php echo $data_form['company_tel_center']; ?>">
				<input type="hidden" name="company_tel_right" value="<?php echo $data_form['company_tel_right']; ?>">
				<input type="hidden" name="password_point" value="<?php echo $data_form['password_point']; ?>">
				<input type="hidden" name="password_login" value="<?php echo $data_form['password_login']; ?>">
				 <p class="btn gray"><button class="submit" type="submit" name="goback" >戻る</button></p>
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