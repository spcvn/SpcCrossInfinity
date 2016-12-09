<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
		
		<?php $this->view('frontend/layout/_user_menu'); ?>
	
		</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form>
				<h2 class="user">マイページ(ユーザー)</h2>
				
				<div class="edit_btn col1">
					<a href="<?php echo base_url('user/edit'); ?>">編集</a>
				</div>
				
				 <table class="form confirm">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員名<span class="must">※</span></th>
						<td>
						<?php echo $user['name'] ?>
						</td>
					 </tr>
					 <tr>
						<th>ふりがな<span class="must">※</span></th>
						<td>
						<?php echo $user['name_kana'] ?>
						</td>
					 </tr>
					 <tr>
						<th>郵便番号<span class="must">※</span></th>
						<td>
						〒 <?php echo $user['post_code'] ?>
						</td>
					 </tr>
					 <tr>
						<th>都道府県<span class="must">※</span></th>
						<td>
							<?php echo  $this->Prefecture_model->get_item_prefecture($user['prefecture_id'])['prefecture_name']; ?>
						</td>
					 </tr>
					 <tr>
						<th>市区町村<span class="must">※</span></th>
						<td>
						<?php echo $user['city'] ?>
						</td>
					 </tr>
					 <tr>
						<th>連絡先<span class="must">※</span></th>
						<td>
						<?php echo $user['tel'] ?>
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス<span class="must">※</span></th>
						<td>
						<?php echo $user['mail'] ?>
						</td>
					 </tr>
					 <tr>
					 	<th>紹介者ID</th>
						<td>
						<?php
							$introduce_uid =  $this->User_model->get_user($user['introduce_uid']);
							$introducer_name = NULL;
							if($introduce_uid != false){
								$introducer_name= $introduce_uid['uid_name'];
							}
							$class_error_introducer = !empty(form_error('introduce_uid')) ? "error" : "";
						?>
						<?php  echo $introducer_name; ?>
						</td>
					 </tr>
					 <tr>
					 	<th>&nbsp;</th>
						<td class="txt tdkome">
						<!-- <p class="kome">※紹介者がいる場合、記入してください。</p> -->
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>法人様アカウント情報</h3><span class="att">※任意</span></th>
					 </tr>
					 <tr>
					 	<th>法人名</th>
						<td>
						<?php echo $user['company_name'] ?>
						</td>
					 </tr>
					 <tr>
					 	<th>法人住所</th>
						<td>
						<?php echo $user['company_address'] ?>
						</td>
					 </tr>
					 <tr>
					 	<th>法人連絡先</th>
						<td>
						<?php echo $user['company_tel'] ?>
						</td>
					 </tr>
						<th class="h3" colspan="2"><h3>パスワード</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
						<!-- <p class="kome">※ポイント使用パスワードとログインパスワードは<br>同じものは使用不可</p> -->
						</td>
					 </tr>
 					 <tr>
					 	<th class="pb10">ログイン<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$password_login = "";
							for ($i=0; $i < $user['password_login_length']; $i++) { 
								$password_login .= "＊";
							}
							echo $password_login;
						?>
						</td>
					 </tr>
					 <tr>
					 	<th>ポイント使用<br>パスワード<span class="must">※</span></th>
						<td>
						<?php
							$password_point = "";
							for ($i=0; $i < $user['password_point_length']; $i++) { 
								$password_point .= "＊";
							}
							echo $password_point;
						?>
						</td>
					 </tr>
					 </tr>
						<th class="h3" colspan="2"><h3>自己保有ポイント</h3></th>
					 </tr>
					 <tr>
					 	<th>応援ポイント</th>
						<td>
						<?php echo empty($user['point']) ? "0" : number_format($user['point']); ?> pt　
						<a href="<?php echo base_url('user/point-detail'); ?>">ポイント詳細はこちら</a>
						
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 
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