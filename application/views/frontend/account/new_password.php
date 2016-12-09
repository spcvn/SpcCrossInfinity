<div id="contents">
	<header>
		<img class="logo" src="<?php echo base_url('assets/frontend'); ?>/img/logo.png" srcset="<?php echo base_url('assets/frontend'); ?>/img/logo.png 1x, <?php echo base_url('assets/frontend'); ?>/img/logo@2x.png 2x" alt="">
	</header>
	<div class="main">
		<article>
			<section>
				<form id="form_new_password" action="<?php echo base_url('new-password'); ?>" method="POST">
					<input type="hidden" name="reset_token" value="<?php echo isset($token) ? $token : ''; ?>">
					<h2 class="lock">ログインパスワード再設定</h2>
					
					 <table class="form pt20">
					 <tbody>
						 <tr>
							<td colspan="2" class="txt center">
							以下の入力フォームに新しいログインパスワード<br>								
							を入力し、登録ボタンを押してください。
							</td>
						 </tr>
						 <tr>
							<th>新しいログインPASS</th>
							<td>
							<input id="password" type="password" maxlength="50" name="password" value="" placeholder="" class="<?php echo empty(form_error('password')) ? '' : 'error'; ?>">
							<span style="color:red"><?php echo form_error('password'); ?></span>
							</td>
						 </tr>

						 <tr>
							<th>ログインPASSの再入力</th>
							<td>
							<input id="confirm_password" type="password" maxlength="50" name="confirm_password" value="" placeholder="" class="<?php echo empty(form_error('confirm_password')) ? '' : 'error'; ?>">
							<span style="color:red"><?php echo form_error('confirm_password'); ?></span>
							</td>
						 </tr>
						 <?php 
						 	if(isset($token)) {
						 	$account = $this->account->get_account_by_reset_token($token);
						 		if($account->type == 'company'){ ?>
						 <tr>
						 	<td colspan="2"></td>
						 </tr>
						 <tr>
						 	<th>新しい<br>企業情報変更<br>PASS</th>
						 	<td>
						 	<input id="password_reward" type="password" maxlength="50" name="password_reward" value="" placeholder="" class="<?php echo empty(form_error('password_reward')) ? '' : 'error'; ?>">
							<span style="color:red"><?php echo form_error('password_reward'); ?></span>
						 	</td>
						 </tr>
						 <tr>
						 	<th>企業情報変更<br>PASSの再入力</th>
						 	<td>
						 	<input id="confirm_password_reward" type="password" maxlength="50" name="confirm_password_reward" value="" placeholder="" class="<?php echo empty(form_error('confirm_password_reward')) ? '' : 'error'; ?>">
							<span style="color:red"><?php echo form_error('confirm_password_reward'); ?></span>
						 	</td>
						 </tr>
						 <?php } }?>
					 </tbody>
					 </table>

					 <p class="btn_submit"><button type="submit" class="submit">登録</button></p>
					 
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