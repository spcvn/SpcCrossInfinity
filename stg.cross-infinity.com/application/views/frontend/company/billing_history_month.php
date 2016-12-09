<style>
	nav.pagenation {
		text-align: center;
	}
	nav.pagenation a {
		padding-top: 8px;
    	padding-right: 15px;
    	margin-right: 5px;
	}
</style>
<div id="contents">
<header>
	<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
	<?php $this->view('frontend/layout/_company_menu'); ?>
</header>

<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>

				<h2 class="kigyou">売上請求照会
					<div class="select_btn">
						<div id="showmenu" class="init_btn">月別 &#9660;</div>
						<!-- <a  href="<?php echo base_url('company/billing-history-by-month');?>" class="init_btn"> </a> --><span id="showmenu"><!-- 月別 &#9660; --></span>
						<ul class="second_level">
							<li><a href="<?php echo base_url('company/billing-history-by-day');?>">日別 &nbsp;&nbsp;</a></li>
						</ul>
					</div>
				</h2>

				 <table class="tile td_bold">
				 <tbody>
					 <tr>
						<th class="r2">月</th>
						<th class="r3">売上金額</th>
						<th class="r3">請求金額</th>
					 </tr>
					<?php foreach($results as $value){  ?>  
					 <tr>
						<td><a href="<?php echo base_url().'company/billing-history-month?month='.date_format(date_create($value->charge_month),"m");?>"><?php echo date_format(date_create($value->charge_month),"m");?>月</a></td>
						<td>¥<?php echo number_format($value->total_sales);?></td>
						<td>¥<?php echo number_format($value->total_reward);?></td>
					 </tr>
					<?php } ?>
				 </table>
				 
				<?php echo $links; ?>
			<?php
				$seg = ($this->uri->segment(3) == NULL) ? 1 : $this->uri->segment(3);
				$min = $seg * RECORD_PER_PAGE -RECORD_PER_PAGE + 1;
				$max = $min + count($results) -1;
				?>
				<?php if (count($results) == 0) {?>
				<p class="pagenation_counter">
					<span class="active">0</span> / <span class="all">0</span>
				</p>	
				<?php }else{ ?>	
				<p class="pagenation_counter">
					<span class="active"><?php echo $min;?> - <?php echo $max;?> </span> / <span class="all"><?php echo $total;?></span>
				</p>
				<?php } ?>			

			</section>
		</article>
		<!--▲▲▲article▲▲▲-->
	</div>

<footer id="footer">
		<div class="footerCopy">
			<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
		</div>
	</footer>
	<!--▲▲▲footer▲▲▲-->
</div>
