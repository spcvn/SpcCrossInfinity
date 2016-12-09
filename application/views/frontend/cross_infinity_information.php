<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">

		<!-- #BeginLibraryItem "/Library/ユーザーメニュー.lbi" -->

		<?php 
		if( $this->session->userdata('type') == 'company'){
			$this->view('frontend/layout/_company_menu');
		}
		if( $this->session->userdata('type') == 'user'){
			$this->view('frontend/layout/_user_menu');
		}
		 ?>
		<!-- #EndLibraryItem -->	

	</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form>
				<h2 class="kigyou">CROSS INFINITY情報</h2>
				
				 <table class="form">
				 <tbody>
				 	<?php 
				 		foreach ($cross_infinity as $item) {
				 	?>
				 	<tr>
						<th><?php echo $item->information_name ?>:</th>
						<td><?php echo  $item->ci_id == 7 ? number_format($item->information_content) : $item->information_content ?></td>
					</tr>
					<?php } ?>
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