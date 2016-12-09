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
			<form>
				<h2 class="kigyou">応援サービス登録 - 完了</h2>
				
				 <table class="form confirm th_wide">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>アカウント情報</h3></th>
					 </tr>
					 <tr>
						<th>会員IDまたは<br>紹介者会員ID<span class="must">※</span></th>
						<td>
							<?=$data_purchase->introduce_uid_name; ?>
						</td>
					 </tr>
					 <tr>
						<th>購入金額<span class="must">※</span></th>
						<td>
							<?=number_format($data_purchase->buy_price); ?> 円
						</td>
					 </tr>
					 <tr>
						<th>使用ポイント</th>
						<td>
							<?=number_format($data_purchase->point_use); ?> ポイント
						</td>
					 </tr>
					 <tr>
						<th>ポイント使用<br>パスワード</th>
						<td class="v_middle">
							<?php 
								if(isset($data_purchase->password_point)) {
									echo $data_purchase->password_point;
								}
							?>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <p class="btn orange"><a href="<?php echo base_url('company/regist-purchase'); ?>">応援サービス登録へ</a></p>
				 <p class="btn gray"><a href="<?php echo base_url('company/billing_history_by_day'); ?>">売上請求照会へ</a></p>
				 
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