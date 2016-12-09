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
			<form>
				<h2 class="user">ポイント詳細</h2>
				
				 <table class="form">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>合計応援ポイント</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
							<div class="note">
								<div class="pt">
									<?php echo !empty($user['point']) ? number_format($user['point']) : 0 ?><span>pt</span>
								</div>
							</div>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				 <table class="form">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>紹介者応援ポイント</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
							<div class="note">
								<div class="pt">
									<?php echo 
									empty($introduce_point_user->introduce_point_user1) ? 0 : number_format($introduce_point_user->introduce_point_user1); ?><span>pt</span>
								</div>
							</div>
						</td>
					 </tr>
				 </tbody>
				 </table>

				 <table class="tile">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>紹介企業ポイント</h3></th>
					 </tr>
				 </tbody>
				 </table>
				 <?php if($list_company != false){ ?>
				 <table class="tile add_h3">
				 <tbody>
					 <!--<tr>
						<th class="h3 top" colspan="2"><h3>紹介企業ポイント</h3></th>
					 </tr>-->
					 <tr>
						<th>利用日時</th>
						<th class="r1">企業名</th>
						<th>ポイント</th>
						<th>pt加算</th>
					 </tr>
					 <?php
					 	
					 	foreach ($list_company as $item) {
					 ?>
					 <tr>
						<td><?php echo $item->buy_time; ?></td>
						<td><?php echo $item->name; ?></td>
						<td><?php echo empty($item->introduce_point_company1) ? 0 : number_format($item->introduce_point_company1); ?>pt</td>
						
						<td><?php echo $item->point_add == 0 ? '未' : '済'; ?></td>
					 </tr>
					 <?php } ?>
				 </tbody>
				 </table>
				 <?php echo $this->pagination->create_links();?>
				<p class="pagenation_counter">
					<span class="active"><?php echo $per_page; ?></span> / <span class="all"><?php echo $total; ?></span>
				</p>
				 <?php } else{ echo "<table class='tile add_h3'><tr><td style='font-size: 16px;'><span style='padding-right: 3px;font-size: 20px;font-weight: bold;'>0</span>pt</td></tr></table>";} ?>
				 <p class="btn gray"><a href="<?php echo base_url('user'); ?>">マイページへ戻る</a></p>
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