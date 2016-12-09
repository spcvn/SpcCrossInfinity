<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url('assets/frontend/img/logo.png 1x'); ?>, <?php echo base_url('assets/frontend/img/logo@2x.png 2x'); ?>" alt=""><!-- #BeginLibraryItem "/Library/企業メニュー.lbi" -->
		<?php $this->view('frontend/layout/_company_menu'); ?>
<!-- #EndLibraryItem --></header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form action="<?php echo base_url('company/success-purchase'); ?>" method="post">
				<h2 class="kigyou">応援サービス登録 - 確認</h2>
				
				 <table class="form confirm th_wide">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員IDまたは<br>紹介者会員ID<span class="must">※</span></th>
						<td>
							<?=$introduce_uid; ?>
						</td>
					 </tr>
					 <tr>
						<th>購入金額<span class="must">※</span></th>
						<td>
							<?=number_format($buy_price); ?> 円
						</td>
					 </tr>
					 <tr>
						<th>使用ポイント</th>
						<td>
							<?php 
								if($point != '') {
									echo number_format($point).' ポイント';
								} else {
									echo '0 ポイント';
								}
							?>
						</td>
					 </tr>
					 <tr>
						<th>ポイント使用<br>パスワード</th>
						<td class="v_middle">
							<?php 
								if($password_point != '') {
									$leng_password_point = strlen($password_point);
									$password_point_display = '';
									for($i = 0; $i < $leng_password_point; $i++) {
										$password_point_display .= '*';
									}
									echo $password_point_display;
								}
							?>
						</td>
					 </tr>
				 </tbody>
				 </table>
				<input type="hidden" name="introduce_uid" value="<?=$introduce_uid; ?>" />
				<input type="hidden" name="buy_price" value="<?=$buy_price; ?>" />
				<input type="hidden" name="point" value="<?=$point; ?>" />
				<input type="hidden" name="password_point" value="<?=$password_point; ?>" />
				<p class="btn_submit"><button type="submit" class="submit">送信</button></p>
			</form>
			<form action="<?php echo base_url('company/regist-purchase'); ?>" method="post">
				<input type="hidden" name="introduce_uid" value="<?=$introduce_uid; ?>" />
				<input type="hidden" name="buy_price" value="<?=$buy_price; ?>" />
				<input type="hidden" name="point" value="<?=$point; ?>" />
				<input type="hidden" name="password_point" value="<?=$password_point; ?>" />
				<p class="btn gray"><input type="submit" class="backButton" value="戻る"></p>
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

<style type="text/css">
	.backButton {
		background-color: #b8b8b8;
		width: 355px;
	    padding: 18px 0;
	    display: table;
	    text-align: center;
	    color: #fff;
	    font-size: 18px;
	    border-radius: 5px;
	    font-weight: bold;
	    font-family: "Avenir Next","ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","游ゴシック","Yu Gothic","メイリオ",Meiryo,Osaka,sans-serif;
	}

	.backButton:hover {
		opacity: 0.8;
	}
</style>