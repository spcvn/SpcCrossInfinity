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
			<form action="<?php echo base_url('user/success') ?>" method="POST" id="form_registration">
				<h2 class="user">ユーザー登録 - 完了</h2>
				
				 <table class="form confirm">
				 <tbody>
					 <tr>
						<td colspan="2" class="txt">
							<div class="note ms">
								<div class="thanks">
									ありがとうございます！ <br>
									ご登録が完了いたしました。
								</div>
								<hr>
								
								下記メールアドレスに、個人を特定できる<br> 
								書類の送付をお願い致します。<br>
								<br>
								・免許書<br>
								・保険証<br>
								・パスポート<br><br>
								<br>
								メールアドレス<br><br/>
								add@cross-infinity.com
								<br><br/>				
								確認取れ次第、IDをメールで送信致します。
								<br>
								そのIDからログインを行ってください！<br>
								<br>
								<a href="http://cross-infinity.com">
								http://cross-infinity.com
								</a>
							</div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 <p class="btn orange"><a href="<?php echo base_url('login'); ?>">トップに戻る</a></p>
				 <!-- <p class="btn gray"><button class="submit" type="submit" name="sendmail" >お問い合わせ</button></p> -->
				 <p class="btn gray">
				 	<!-- <a href="<?php echo base_url('login'); ?>">お問い合わせ</a> -->
				 	<a  class="popup-modal" href="#test-modal">お問い合わせ</a>
				 </p>
				 
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