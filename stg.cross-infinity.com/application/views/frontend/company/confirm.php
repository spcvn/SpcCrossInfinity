<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url().'assets/frontend/img/logo.png';?>" srcset="<?php echo base_url().'assets/frontend/img/logo.png 1x';?>, <?php echo base_url().'assets/frontend/img/logo@2x.png 2x';?>" alt="">
	</header>
	<!--▲▲▲header▲▲▲-->

	<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>
			<form action="<?php echo base_url('company/success'); ?>" method="post">
				<h2 class="kigyou">企業登録 - 確認</h2>
				 <table class="form confirm break-character">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>企業情報</h3></th>
					 </tr>
					 <tr>
						<th class="label-header">企業名<span class="must">※</span></th>
						<td class="content-input">
						<?=$name; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">郵便番号<span class="must">※</span></th>
						<td class="content-input">
						〒<?=$post_code_1; ?>-<?=$post_code_2; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">都道府県<span class="must">※</span></th>
						<td class="content-input">
							<?=$prefecture_name; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">市区町村<span class="must">※</span></th>
						<td class="content-input">
							<?=$city; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">番地以降<span class="must">※</span></th>
						<td class="content-input">
							<?=$street_address; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">最寄駅</th>
						<td class="content-input">
						 <?=$station; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">企業連絡先<span class="must">※</span></th>
						<td class="content-input">
							<?=$tel; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">メールアドレス<span class="must">※</span></th>
						<td class="content-input">
							<?=$mail; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">URL</th>
						<td class="content-input">
							<?=$outside_url; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">会社PR</th>
						<td class="content-input">
							<?=$public_relations; ?>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>企業補足情報</h3></th>
					 </tr>
					 <tr>
					 	<th class="label-header">担当者名<span class="must">※</span></th>
						<td class="content-input">
							<?=$representative; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">担当者連絡先<span class="must">※</span></th>
						<td class="content-input">
							<?=$rep_tel; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">担当者<br>メールアドレス<span class="must">※</span></th>
						<td class="content-input">
							<?=$rep_address; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">企業紹介者ID<span class="must">※</span></th>
						<td class="content-input">
							<?=$introduce_uid; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">カテゴリ<span class="must">※</span></th>
						<td class="content-input">
						 <?=$category_name; ?>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>口座情報</h3></th>
					 </tr>
					 <tr>
					 	<th class="label-header">金融機関名<span class="must">※</span></th>
						<td class="content-input">
							<?=$bank_name; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">店番号<span class="must">※</span></th>
						<td class="content-input">
							<?=$bank_branch_number; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">預金種目<span class="must">※</span></th>
						<td class="content-input">
							<?php
								if($bank_type == 0) {
									echo '普通預金';
								} else {
									echo '当座預金';
								}
							?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">口座番号<span class="must">※</span></th>
						<td class="content-input">
							<?=$bank_number; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">口座名義人<span class="must">※</span></th>
						<td class="content-input">
							<?=$bank_holder; ?>
						</td>
					 </tr>
					 <tr>
						<th class="h3" colspan="2"><h3>パスワード</h3></th>
					 </tr>
					 <tr>
						<td colspan="2" class="txt">
						<p class="kome">※ログインパスワードと企業情報変更パスワードは同じものは使用不可</p>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">ログイン<br>パスワード<span class="must">※</span></th>
						<td class="content-input">
							<?=$password_login_edit; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">企業情報変更<br>パスワード<span class="must">※</span></th>
						<td class="content-input">
							<?=$password_reward_edit; ?>
						</td>
					 </tr>
				 </tbody>
				 </table>
				 
				<h2 class="txt_only">応援条件登録</h2>
				
				 <table class="form confirm break-character">
				 <tbody>
					 <tr>
						<th class="h3 top" colspan="2"><h3>応援条件</h3></th>
					 </tr>
					 <tr>
						<th class="label-header">応援区分<span class="must">※</span></th>
						<td class="content-input">
							<?php 
								if($reward_group == '1'){
									echo '通常応援';
								} elseif($reward_group == '2') {
									echo '応援不要企業寄付';
								} elseif($reward_group == '3') {
									echo '寄付';
								}
							?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">応援対象年月日<br>From<span class="must">※</span></th>
						<td class="content-input">
							<?=$reward_from_data; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">応援対象年月日<br>To</th>
						<td class="content-input">
							<?=$reward_to_data; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">応援対象時間<br>From<span class="must">※</span></th>
						<td class="content-input">
							<?=$reward_from_time; ?>
						</td>
					 </tr>
					 <tr>
						<th class="label-header">応援対象時間<br>To</th>
						<td class="content-input">
							<?=$reward_to_time; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">応援適用最低金額<span class="must">※</span></th>
						<td class="content-input">
							<?=number_format($applied_lowest_price); ?> 円
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">購入者割引<span class="must">※</span></th>
						<td class="content-input">
							<?php if($discount_price != ''): ?>
								<?=number_format($discount_price); ?> 円
							<?php else: ?>
								<?=$discount_rate; ?> &#37;
							<?php endif; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">販売促進費<span class="must">※</span></th>
						<td class="content-input">
							<?php if($reward_point != ''): ?>
								<?=number_format($reward_point); ?> 円
							<?php else: ?>
								<?=$reward_point_rate; ?> &#37;
							<?php endif; ?>
						</td>
					 </tr>
					 <tr>
					 	<th class="label-header">応援内容説明<span class="must">※</span></th>
						<td class="content-input">
							<?=$reward_content; ?>
						</td>
					 </tr>
				 </tbody>
				 </table>
				<input type="hidden" name="name" value="<?=$name?>" />
				<input type="hidden" name="post_code_1" value="<?=$post_code_1; ?>" />
				<input type="hidden" name="post_code_2" value="<?=$post_code_2; ?>" />
				<input type="hidden" name="prefecture_id" value="<?=$prefecture_id; ?>" />
				<input type="hidden" name="city" value="<?=$city; ?>" />
				<input type="hidden" name="street_address" value="<?=$street_address; ?>" />
				<input type="hidden" name="station" value="<?=$station; ?>" />
				<input type="hidden" name="tel_1" value="<?=$tel_1; ?>" />
				<input type="hidden" name="tel_2" value="<?=$tel_2; ?>" />
				<input type="hidden" name="tel_3" value="<?=$tel_3; ?>" />
				<input type="hidden" name="mail" value="<?=$mail; ?>" />
				<input type="hidden" name="outside_url" value="<?=$outside_url; ?>" />
				<input type="hidden" name="public_relations" value="<?=$public_relations; ?>" />
				<input type="hidden" name="representative"  value="<?=$representative; ?>" />
				<input type="hidden" name="rep_tel_1" value="<?=$rep_tel_1; ?>" />
				<input type="hidden" name="rep_tel_2" value="<?=$rep_tel_2; ?>" />
				<input type="hidden" name="rep_tel_3" value="<?=$rep_tel_3; ?>" />
				<input type="hidden" name="rep_address" value="<?=$rep_address; ?>" />
				<input type="hidden" name="introduce_uid" value="<?=$introduce_uid; ?>" />
				<input type="hidden" name="category_id" value="<?=$category_id; ?>" />
				<input type="hidden" name="bank_name" value="<?=$bank_name; ?>" />
				<input type="hidden" name="bank_branch_number" value="<?=$bank_branch_number; ?>" />
				<input type="hidden" name="bank_type" value="<?=$bank_type; ?>" />
				<input type="hidden" name="bank_number" value="<?=$bank_number; ?>" />
				<input type="hidden" name="bank_holder" value="<?=$bank_holder; ?>" />
				<input type="hidden" name="password_login" value="<?=$password_login; ?>" />
				<input type="hidden" name="password_reward" value="<?=$password_reward; ?>" />
				<input type="hidden" name="reward_group" value="<?=$reward_group; ?>" />
				<input type="hidden" name="reward_from_data" value="<?=$reward_from_data; ?>" />
				<input type="hidden" name="reward_to_data" value="<?=$reward_to_data; ?>" />
				<input type="hidden" name="reward_from_time" value="<?=$reward_from_time; ?>" />
				<input type="hidden" name="reward_to_time" value="<?=$reward_to_time; ?>" />
				<input type="hidden" name="applied_lowest_price" value="<?=$applied_lowest_price; ?>" />
				<input type="hidden" name="discount_price" value="<?=$discount_price; ?>" />
				<input type="hidden" name="discount_rate" value="<?=$discount_rate; ?>" />
				<input type="hidden" name="reward_point" value="<?=$reward_point; ?>" />
				<input type="hidden" name="reward_point_rate" value="<?=$reward_point_rate; ?>" />
				<input type="hidden" name="reward_content" value="<?=$reward_content; ?>" />
				<input type="hidden" name="agree" value="<?=$agree; ?>" />
				<p class="btn_submit"><button type="submit" class="submit">登録</button></p>
			</form>
			<form action="<?php echo base_url('company/registration'); ?>" method="post" >
				<input type="hidden" name="name" value="<?=$name?>" />
				<input type="hidden" name="post_code_1" value="<?=$post_code_1; ?>" />
				<input type="hidden" name="post_code_2" value="<?=$post_code_2; ?>" />
				<input type="hidden" name="prefecture_id" value="<?=$prefecture_id; ?>" />
				<input type="hidden" name="city" value="<?=$city; ?>" />
				<input type="hidden" name="street_address" value="<?=$street_address; ?>" />
				<input type="hidden" name="station" value="<?=$station; ?>" />
				<input type="hidden" name="tel_1" value="<?=$tel_1; ?>" />
				<input type="hidden" name="tel_2" value="<?=$tel_2; ?>" />
				<input type="hidden" name="tel_3" value="<?=$tel_3; ?>" />
				<input type="hidden" name="mail" value="<?=$mail; ?>"/>
				<input type="hidden" name="outside_url" value="<?=$outside_url; ?>" />
				<input type="hidden" name="public_relations" value="<?=$public_relations; ?>" />
				<input type="hidden" name="representative"  value="<?=$representative; ?>" />
				<input type="hidden" name="rep_tel_1" value="<?=$rep_tel_1; ?>" />
				<input type="hidden" name="rep_tel_2" value="<?=$rep_tel_2; ?>" />
				<input type="hidden" name="rep_tel_3" value="<?=$rep_tel_3; ?>" />
				<input type="hidden" name="rep_address" value="<?=$rep_address; ?>" />
				<input type="hidden" name="introduce_uid" value="<?=$introduce_uid; ?>" />
				<input type="hidden" name="category_id" value="<?=$category_id; ?>" />
				<input type="hidden" name="bank_name" value="<?=$bank_name; ?>" />
				<input type="hidden" name="bank_branch_number" value="<?=$bank_branch_number; ?>" />
				<input type="hidden" name="bank_type" value="<?=$bank_type; ?>" />
				<input type="hidden" name="bank_number" value="<?=$bank_number; ?>" />
				<input type="hidden" name="bank_holder" value="<?=$bank_holder; ?>" />
				<input type="hidden" name="password_login" value="<?=$password_login; ?>" />
				<input type="hidden" name="password_reward" value="<?=$password_reward; ?>" />
				<input type="hidden" name="reward_group" value="<?=$reward_group; ?>" />
				<input type="hidden" name="reward_from_data" value="<?=$reward_from_data; ?>" />
				<input type="hidden" name="reward_to_data" value="<?=$reward_to_data; ?>" />
				<input type="hidden" name="reward_from_time" value="<?=$reward_from_time; ?>" />
				<input type="hidden" name="reward_to_time" value="<?=$reward_to_time; ?>" />
				<input type="hidden" name="applied_lowest_price" value="<?=$applied_lowest_price; ?>" />
				<input type="hidden" name="discount_price" value="<?=$discount_price; ?>" />
				<input type="hidden" name="discount_rate" value="<?=$discount_rate; ?>" />
				<input type="hidden" name="reward_point" value="<?=$reward_point; ?>" />
				<input type="hidden" name="reward_point_rate" value="<?=$reward_point_rate; ?>" />
				<input type="hidden" name="reward_content" value="<?=$reward_content; ?>" />
				<p class="btn gray"><input type="submit" class="backButton" value="戻る" /></p>	
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

