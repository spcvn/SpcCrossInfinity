<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="img/logo.png" srcset="<?php echo base_url().'assets/frontend/img/logo.png 1x'; ?>, <?php echo base_url().'assets/frontend/img/logo@2x.png 2x'; ?>" alt="">
	</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
				<form id="complete-form" action="<?php echo base_url(''); ?>" method="get">
					<h2 class="kigyou">企業登録 - 完了</h2>

					<table class="form confirm">
						<tbody>
							<tr>
								<td colspan="2" class="txt">
									<div class="note ms">
										<div class="thanks" style="font-weight: normal">
											ありがとうございます！ <br>
											ご登録が完了いたしました。
										</div>
										<hr>

										<table class="account">
											<tbody>
											<?php 
												$url = '';
												$vat = 0;
												foreach ($crossinfinity as $information) { 
													if($information->ci_id == '8') {
														$url = $information->information_content;
														continue;
													}
													if($information->ci_id == '7'){
														$vat = $information->information_content;
													}
											?>
												<tr>
													<th style="font-weight: normal"><?php echo $information->information_name; ?>:</th>
													<td style="font-weight: normal"><?php echo $information->information_content; ?></td>
												</tr>
												
											<?php 
												}; 
											?>
											</tbody>
										</table>

										上記口座へ年会費<br>
										<?php
										$month = $vat/12;
										echo '（月額'.number_format($month).'×12か月分）='.number_format($vat).'(税別)';
										?>
										<br>
										の振込が確認出来次第、<br>
										IDをメールで送信致します。<br>
										そのIDからログインを行ってください！<br>
										<br>
										<a href="<?=$url; ?>">
											<?=$url; ?>
										</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>

					<p class="btn orange"><button type="submit"><a>トップに戻る</a></button></p>
					<p class="btn gray"><a href="mailto:info@cross-infinity.com?Subject=Contact Email">お問い合わせ</a></p>

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
