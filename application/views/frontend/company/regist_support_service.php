<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url('assets/frontend/img/logo.png 1x'); ?>, <?php echo base_url('assets/frontend/img/logo@2x.png 2x'); ?>" alt=""><!-- #BeginLibraryItem "/Library/企業メニュー.lbi" -->
		<?php $this->view('frontend/layout/_company_menu'); ?>
	</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form action="<?php echo base_url('company/confirm-purchase'); ?>" method="post" id="form_regist_support">
				<h2 class="kigyou">応援サービス登録</h2>
				
				 <table class="form confirm">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員IDまたは<br>紹介者会員ID<span class="must">※</span></th>
						<td>
						<?php
							$class_error_introduce_uid = !empty(form_error('introduce_uid')) ? "error" : "";
						?>
						<!-- <input type="text" name="introduce_uid" value="<?php echo !empty(set_value('introduce_uid')) ? set_value('introduce_uid') : "JPU000000000" ; ?>" placeholder="" maxlength="12" class="<?=$class_error_introduce_uid; ?>" onfocus="hidePHPMessageByName('introduce_uid')"> -->

						<!-- Unotrung modifine  -->
						<input type="text" name="introduce_uid" value="<?php echo !empty($introduce_uid) ? $introduce_uid : "JPU000000000" ; ?>" placeholder="" maxlength="12" class="<?=$class_error_introduce_uid; ?>" onfocus="hidePHPMessageByName('introduce_uid')">

						<span style="color:red" class="error-introduce_uid"><?php echo form_error('introduce_uid'); ?></span>
						<div id="introduce_uid"></div>
						</td>
					 </tr>
					 <tr>
						<th>購入金額<span class="must">※</span></th>
						<td>
						<?php
							$class_error_buy_price = !empty(form_error('buy_price')) ? "error" : "";
						?>
						<input type="tel" name="buy_price" value="<?php echo set_value('buy_price'); ?>" placeholder="" class="w150 <?=$class_error_buy_price?>" maxlength="9"> 円
						<span style="color:red"><?php echo form_error('buy_price'); ?></span>
						<div id="buy_price"></div>
						</td>
					 </tr>
					 <tr>
						<th>使用ポイント</th>
						<td>
						<?php
							$class_error_point = !empty(form_error('point')) ? "error" : "";
						?>
						<input type="tel" name="point" value="<?php echo set_value('point'); ?>" placeholder="" class="w150 <?=$class_error_point; ?>" maxlength="9"> ポイント
						<span style="color:red"><?php echo form_error('point'); ?></span>
						<div id="point"></div>
						</td>
					 </tr>
					 <tr>
						<th>ポイント使用<br>パスワード</th>
						<td>
						<?php
							$class_error_password_point = !empty(form_error('password_point')) ? "error" : "";
						?>
						<input type="password" name="password_point" value="<?php echo set_value('password_point'); ?>" placeholder="" maxlength="20" class="<?=$class_error_password_point; ?>">
						<span style="color:red" class="error-controller"><?php echo form_error('password_point'); ?></span>
						<div id="password_point"></div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn_submit"><button type="submit" class="submit">確認</button></p>
				 
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