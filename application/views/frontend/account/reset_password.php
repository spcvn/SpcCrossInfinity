<div id="contents">
	<header>
		<img class="logo" src="<?php echo base_url('assets/frontend'); ?>/img/logo.png" srcset="<?php echo base_url('assets/frontend'); ?>/img/logo.png 1x, <?php echo base_url('assets/frontend'); ?>/img/logo@2x.png 2x" alt="">
	</header>
	<div class="main">
		<article>
			<section>
			<form id="form_reset_password" action="<?php echo base_url('reset-password'); ?>" method="POST" novalidate>
				<h2 class="lock">ログインパスワード再設定依頼</h2>
				
				 <table class="form pt20">
				 <tbody>
					 <tr>
						<td colspan="2" class="txt center">
						ログインパスワードの再設定を行います。<br/>
						以下の入力フォームにご登録されたメールアドレスを<br/>
						入力し、送信ボタンを押してください。
						</td>
					 </tr>
					 <tr>
						<th>メールアドレス</th>
						<td>
							<?php 
							$email = isset($data_form['email']) ? $data_form['email'] : set_value('email');
							$class_error_email = !empty(form_error('email')) ? "error" : "";
						?>
						<input type="email" name="email" value="<?php echo $email; ?>" placeholder="" class="<?php echo $class_error_email; ?>" onfocus="hidePHPMessage()" maxlength="255">
						<?php echo '<span class="error error-controller">'.form_error('email').'</span>' ?>
						</td>
					 </tr>
				 </tbody>
				 </table>

				 <p class="btn_submit"><button type="submit" class="submit">送信</button></p>
				 
			</form>	 
			</section>
		</article>
	</div>
	<footer id="footer">
		<div class="footerCopy">
			<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
		</div>
	</footer>
</div>