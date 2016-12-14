<div id="contents">
	<!--▼▼▼header▼▼▼-->
	<header>
		<img class="logo" src="<?php echo base_url(); ?>assets/frontend/img/logo.png" srcset="<?php echo base_url(); ?>assets/frontend/img/logo.png 1x, <?php echo base_url(); ?>assets/frontend/img/logo@2x.png 2x" alt="">
		
		<?php $this->view('frontend/layout/_company_menu'); ?>
	
		</header>
<!--▼▼▼main▼▼▼-->
<div class="main">
	<!--▼▼▼article▼▼▼-->
	<article>
		<section>
		<form>
			<h2 class="kigyou">マイページ(企業)</h2>
			
			<div class="edit_btn">
				<a href="<?php echo base_url()."company/edit"; ?>">企業情報編集 &#155;</a>
				<a rel="leanModal" href="#delete_box" class="delete" id="show_support_btn">応援条件編集 &#155;</a>
			</div>
			 <table class="form confirm break-character">
			 <tbody>
				 <tr>
					<th class="h3 top" colspan="2"><h3>企業情報</h3></th>
				 </tr>
				 <tr>
					<th class="label-header">企業名<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->name; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">郵便番号<span class="must">※</span></th>
					<td class="content-input">
						〒<?=$company_info->post_code; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">都道府県<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->prefecture_name; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">市区町村<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->city; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">番地以降<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->street_address; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">最寄駅</th>
					<td class="content-input">
						<?=$company_info->station; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">企業連絡先<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->tel; ?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">メールアドレス<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->mail;?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">URL</th>
					<td class="content-input">
						<?=$company_info->outside_url;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">会社PR</th>
					<td class="content-input">
						<?=$company_info->public_relations;?>
					</td>
				 </tr>
				 <tr>
					<th class="h3" colspan="2"><h3>企業補足情報</h3></th>
				 </tr>
				 <tr>
				 	<th class="label-header">担当者名<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->representative;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">担当者連絡先<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->rep_tel;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">担当者<br>メールアドレス<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->rep_address;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">企業紹介者ID<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->uid_name;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">カテゴリ<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->category_name;?>
					</td>
				 </tr>
				 <tr>
					<th class="h3" colspan="2"><h3>口座情報</h3></th>
				 </tr>
				 <tr>
				 	<th class="label-header">金融機関名<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->bank_name;?>銀行
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">店番号<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->bank_branch_number;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">預金種目<span class="must">※</span></th>
					<td class="content-input">
						<?php
							if($company_info->bank_type == 0) {
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
						<?=$company_info->bank_number;?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">口座名義人<span class="must">※</span></th>
					<td class="content-input">
						<?=$company_info->bank_holder; ?>
					</td>
				 </tr>
				 <tr>
					 <th class="h3" colspan="2"><h3>Files</h3></th>
				 </tr>
				 <tr>
					 <td colspan="2" class="txt">
						 <?php
						 if($data_file){
						 	foreach ($data_file as $file){ ?>
                                <a target="_blank" href="<?php echo base_url().$file['file']; ?>">
                                    <img class="companyFilesLogo" src="<?php echo base_url(); ?>assets/frontend/images/<?php echo $file['logo']?>" title="<?php echo $file['title']?>">
                                </a>
						<?php }} ?>

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
						<?php
							$length_password_login = $company_info->password_login_length;
							$password_login = '';
							for($i = 0; $i < $length_password_login; $i++) {
								$password_login .= '＊';
							}
							echo $password_login;
						?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">企業情報変更<br>パスワード<span class="must">※</span></th>
					<td class="content-input">
						<?php
							$length_password_reward = $company_info->password_reward_length;
							$password_reward = '';
							for($i = 0; $i < $length_password_reward; $i++) {
								$password_reward .= '＊';
							}
							echo $password_reward;
						?>
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
							if($company_info->delete_flg_support == 0) {
								if($company_info->reward_group == '1'){
									echo '通常応援';
								} elseif($company_info->reward_group == '2') {
									echo '応援不要企業寄付';
								} elseif($company_info->reward_group == '3') {
									echo '寄付';
								}	
							}
						?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">応援対象年月日<br>From<span class="must">※</span></th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) {
								echo $company_info->reward_from_data; 
							}
						?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">応援対象年月日<br>To</th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) {
								echo $company_info->reward_to_data;
							}
						?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">応援対象時間<br>From<span class="must">※</span></th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) { 
								echo $company_info->reward_from_time;
							}
						?>
					</td>
				 </tr>
				 <tr>
					<th class="label-header">応援対象時間<br>To</th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) { 
								echo $company_info->reward_to_time;
							}
						?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">応援適用最低金額<span class="must">※</span></th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) {
								echo number_format($company_info->applied_lowest_price).' 円';
							}
						 ?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">購入者割引<span class="must">※</span></th>
					<td class="content-input">
						<?php if($company_info->delete_flg_support == 0) { ?>
							<?php if($company_info->discount_price != 0): ?>
								<?=number_format($company_info->discount_price); ?> 円
							<?php else: ?>
								<?=$company_info->discount_rate; ?> &#37;
							<?php endif; ?>
						<?php } ?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">販売促進費<span class="must">※</span></th>
					<td class="content-input">
						<?php if($company_info->delete_flg_support == 0) { ?>
							<?php if($company_info->reward_point != 0): ?>
								<?=number_format($company_info->reward_point); ?> 円
							<?php else: ?>
								<?=$company_info->reward_point_rate; ?> &#37;
							<?php endif; ?>
						<?php } ?>
					</td>
				 </tr>
				 <tr>
				 	<th class="label-header">応援内容説明<span class="must">※</span></th>
					<td class="content-input">
						<?php
							if($company_info->delete_flg_support == 0) {
								echo $company_info->reward_content;
							}
						?>
					</td>
				 </tr>
			 </tbody>
			 </table>
		</form>	 
		</section>
	</article>
	<!--▲▲▲article▲▲▲-->
</div>
<!--▲▲▲main▲▲▲-->
<footer id="footer">
	<div class="footerCopy">
		<p>copyright(c)2015 CROSS INFINITY, All Rights Reserved.</p>
	</div>
</footer>
<!--▲▲▲footer▲▲▲-->

<div id="delete_box">
	<a href="#" class="modal_close"></a>
	<p style="text-align: center; margin-top: 20px;"><b>企業情報変更パスワードを</b></p>
	<p style="text-align: center;"><b>入力して下さい。</b></p>
	<form id="confirm_password" method="POST" action ="<?php echo base_url('company/support/'); ?>">
		<div style="text-align: center; margin-top: 15px;">
			<?php
				$class_error_password= !empty(form_error('password_confirm')) ? "error" : "";
			?>
			<input type="password" name="password_confirm" class="<?=$class_error_password; ?>" id="password_confirm" autofocus/>
			<input type="hidden" name="is_check_password" value="true"/>
			<span style="color:red;" class="error_password_confirm"><?php echo form_error('password_confirm'); ?></span>
		</div>
		<div class="btn_col">
			<p class="btn orange"><a id="back_button" style="cursor:pointer; background-color: #b8b8b8;">戻る</a></p>
			<p class="btn gray"><a id="confirm_btn" style="cursor:pointer; background-color: #ea8d5b;">確認</a></p>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(window).load(function() {
		<?php
			if(isset($company_info->check_pass)) :
		?>
			$('#lean_overlay').attr('style','display: block; opacity: 0.5;');
			$('#delete_box').attr('style','display: block; position: fixed; z-index: 11000; left: 50%; margin-left: -155px; top: 50px; opacity: 1;');

		<?php
			endif;
		?>

		$('.modal_close').on('click', function() {
			$('#lean_overlay').attr('style','display: none');
			$('#delete_box').attr('style','display: none;');
		});

		$('#lean_overlay').on('click', function() {
			$('#lean_overlay').attr('style','display: none');
			$('#delete_box').attr('style','display: none;');
		});

		$('#back_button').on('click', function() {
			event.preventDefault();
			$('#lean_overlay').attr('style','display: none');
			$('#delete_box').attr('style','display: none;');
		});

		$('#show_support_btn').click(function() {
			$('.error_password_confirm').hide();
			$('#password_confirm').removeClass('error');
		});

	});

	$(function() {
		$('a[rel*=leanModal]').leanModal({
			top: 50,                     // モーダルウィンドウの縦位置を指定
			overlay : 0.5,               // 背面の透明度 
			closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
			modalparent: "#parentdiv",      // 親要素のidを追加
		});

		$("#confirm_btn").click(function(){
			event.preventDefault();
			$("#confirm_password").submit();

		});
	});
</script>
</div>