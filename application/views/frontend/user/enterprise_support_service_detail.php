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
				<h2 class="user">企業応援サービス詳細</h2>

				<?php $this->view('frontend/user/tab_search'); ?>
				
				<p class="search_word"><a href="<?php echo $url; ?>">&#8249; 検索結果に戻る</a></p>
				
				 <table class="tile">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>紹介企業ポイント</h3></th>
					 </tr>
				 </tbody>
				 </table>
				 </table>
				 <table class="form search_detail">
				 <tbody>
					 <tr>
					 	<td>企業名</td>
						<td><?php echo $detail_support->company; ?></td>
					 </tr>
					 <tr>
					 	<td>住所</td>
						<td>
							〒<?php echo $detail_support->post_code; ?><br/>
							<?php echo $detail_support->address; ?></td>
					 </tr>
					 <tr>
					 	<td>カテゴリ</td>
						<td><?php echo $detail_support->category; ?></td>
					 </tr>
					 <tr>
					 	<td>応援対象期間</td>
					 	<?php
					 		$date_from = date("d", strtotime($detail_support->reward_from_data));
					 		$month_from = date("m", strtotime($detail_support->reward_from_data));
					 		$year_from = date("Y", strtotime($detail_support->reward_from_data));
					 		$reward_to_data = NULL;
					 		if($this->User_model->check_date($detail_support->reward_to_data)){
						 		$date_to = date("d", strtotime($detail_support->reward_to_data));
						 		$month_to = date("m", strtotime($detail_support->reward_to_data));
						 		$year_to = date("Y", strtotime($detail_support->reward_to_data));
						 		$reward_to_data = (int)$year_to."年".(int)$month_to."月".(int)$date_to."日";
						 	}
					 	?>
						<td><?php echo (int)$year_from."年".(int)$month_from."月".(int)$date_from."日 ～ ".$reward_to_data; ?><br><?php echo $detail_support->reward_from_time."〜".$detail_support->reward_to_time; ?> </td>
					 </tr>
					 <tr>
					 	<td>応援適用最低金額</td>
						<td><?php echo $detail_support->applied_lowest_price; ?>円</td>
					 </tr>
					 <tr>
					 	<td>購入者割引</td>
						<td><?php echo !empty($detail_support->discount_price) ? $detail_support->discount_price.'円':$detail_support->discount_rate.'%' ; ?></td>
					 </tr>
					 <tr>
					 	<td>応援ポイント</td>
					 	<?php 
					 		$reward_point = 0;
					 		$reward_point_string = "";
					 		if(!empty($detail_support->reward_point)){
					 			$reward_point = $detail_support->reward_point*0.5;
					 			if($reward_point > 1){
					 				$reward_point_string = (int)$reward_point.'pt';
					 			}
					 			else{
					 				$reward_point_string = '0pt';
					 			}
					 		}
					 		else{
					 			$reward_point = $detail_support->reward_point_rate*0.5;
					 			if($reward_point > 1){
					 				$reward_point_string = (int)$reward_point.'%';
					 			}
					 			else{
					 				$reward_point_string = '0%';
					 			}
					 		}
					 	?>
						<td><?php echo  $reward_point_string; ?></td>
					 </tr>
					 <tr>
					 	<td>応援内容</td>
						<td><?php echo $detail_support->reward_content; ?></td>
					 </tr>
					 <tr>
					 	<td>応援区分</td>
						<td>通常応援</td>
					 </tr>
					 <tr>
					 	<td>企業URL</td>
						<td><a href="<?php echo $detail_support->outside_url; ?>" target="_blank" ><?php echo $detail_support->outside_url; ?></a></td>
					 </tr>
					 <tr>
					 	<td>企業PR</td>
						<td><?php echo $detail_support->public_relations; ?></td>
					 </tr>
					 <tr>
					 	<td>担当者名</td>
						<td><?php echo $detail_support->representative; ?></td>
					 </tr>
					 <tr>
					 	<td>担当者連絡先</td>
						<td><?php echo $detail_support->rep_tel; ?></td>
					 </tr>
					 <tr>
						 <td>List File</td>
						 <td>
							 <?php
							 if($data_file){
							 	foreach ($data_file as $file){  ?>
									 <a target="_blank" href="<?php echo base_url().$file['file']; ?>">
										 <img class="companyFilesLogo" src="<?php echo base_url(); ?>assets/frontend/images/<?php echo $file['logo']?>" title="<?php echo $file['title']?>">
									 </a>

							 <?php }} ?>

						 </td>
					 </tr>
				 </tbody>
				 </table>
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