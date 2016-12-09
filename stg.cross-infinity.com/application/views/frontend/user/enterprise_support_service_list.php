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
				<h2 class="user">企業応援サービス一覧</h2>

				<?php $this->view('frontend/user/tab_search'); ?>
				<?php
					$search_word = "";
					if($this->input->get('category') != ""){
						$search_word = $search_category->category_name;
					}
					if(!empty($this->input->get('address'))){
						$search_word = $this->input->get('address');
					}
					if(!empty($this->input->get('station'))){
						$search_word = $this->input->get('station');
					}
					if(!empty($this->input->get('company'))){
						$search_word = $this->input->get('company');
					}
					if(!empty($this->input->get('reward-point'))){
						$reward = $this->input->get('reward') == 'rate' ? '%' : 'pt';
						$search_word = $this->input->get('reward-point').$reward;
					}
				?>
				<p class="search_word">検索ワード：<span><?php echo $search_word; ?></span></p>
				 <table class="seach_list">
				 <tbody>
				 	
				 	<?php 
				 	if(!empty($list_category)){
				 		foreach ($list_category as $item) {
				 	?>
				 	<tr>
						<td>
							<a href="<?php echo base_url('user/service/detail/'.$item->company_reward_id).'?category='.$this->input->get('category').'&page='.$page; ?>">
								<dl>
									<dt>企業名:</dt>
									<dd><?php echo $item->company; ?></dd>
								</dl>
								<dl>
									<dt>カテゴリ:</dt>
									<dd><?php echo $item->category; ?></dd>
								</dl>
							</a>
						</td>
					 </tr>
					<?php 
				 	}
				 	}
				 	elseif(!empty($list_address)){
				 		foreach ($list_address as $item) {
				 	?>
				 	<tr>
						<td>
							<a href="<?php echo base_url('user/service/detail/'.$item->company_reward_id).'?address='.$this->input->get('address').'&page='.$page; ?>">
								<dl>
									<dt>企業名:</dt>
									<dd><?php echo $item->company; ?></dd>
								</dl>
								<dl>
									<dt>カテゴリ:</dt>
									<dd><?php echo $item->category; ?></dd>
								</dl>
							</a>
						</td>
					 </tr>
					 <?php 
				 	}
				 	}
				 	elseif(!empty($list_station)){
				 		foreach ($list_station as $item) {
				 	?>
				 	<tr>
						<td>
							<a href="<?php echo base_url('user/service/detail/'.$item->company_reward_id).'?station='.$this->input->get('station').'&page='.$page; ?>">
								<dl>
									<dt>企業名:</dt>
									<dd><?php echo $item->company; ?></dd>
								</dl>
								<dl>
									<dt>カテゴリ:</dt>
									<dd><?php echo $item->category; ?></dd>
								</dl>
							</a>
						</td>
					 </tr>
					 <?php 
				 	}
				 	}
				 	elseif(!empty($list_company)){
				 		foreach ($list_company as $item) {
				 	?>
				 	<tr>
						<td>
							<a href="<?php echo base_url('user/service/detail/'.$item->company_reward_id).'?company='.$this->input->get('company').'&page='.$page; ?>">
								<dl>
									<dt>企業名:</dt>
									<dd><?php echo $item->company; ?></dd>
								</dl>
								<dl>
									<dt>カテゴリ:</dt>
									<dd><?php echo $item->category; ?></dd>
								</dl>
							</a>
						</td>
					 </tr>
					 <?php 
				 	}
				 	}
				 	elseif(!empty($list_reward_point)){
				 		foreach ($list_reward_point as $item) {
				 	?>
				 	<tr>
						<td>
							<a href="<?php echo base_url('user/service/detail/'.$item->company_reward_id).'?reward-point='.$this->input->get('reward-point').'&reward='.$this->input->get('reward').'&page='.$page; ?>">
								<dl>
									<dt>企業名:</dt>
									<dd><?php echo $item->company; ?></dd>
								</dl>
								<dl>
									<dt>カテゴリ:</dt>
									<dd><?php echo $item->category; ?></dd>
								</dl>
							</a>
						</td>
					 </tr>
				 	<?php
				 	}
				 	}
				 	else{
				 		echo "<p class='search_word'><span>ここには広告が出せます。</br>
				 		ご希望の方は「広告の問合せ」として</br>
				 		qa@cross-infinity.comまでお問合せ</br>
				 		をお願いいたします。</span></p>";
				 	}
				 	?>
				 </tbody>
				 </table>
				 <?php
				 	if(!empty($list_category) ||
				 		!empty($list_address) ||
				 		!empty($list_station) || 
				 		!empty($list_company) ||
				 		!empty($list_reward_point)){
				 ?>
				 <?php echo $this->pagination->create_links();?>
				<p class="pagenation_counter">
					<span class="active"><?php echo !empty($per_page) ? $per_page : ""; ?></span> / <span class="all"><?php echo !empty($total) ? $total : ""; ?></span>
				</p>
				<?php } ?>
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