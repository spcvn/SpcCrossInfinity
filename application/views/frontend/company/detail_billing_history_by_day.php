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

<!--▼▼▼main▼▼▼-->
	<div class="main">
		<!--▼▼▼article▼▼▼-->
		<article>
			<section>

				<h2 class="kigyou small">売上請求照会<span class="sub">(日別履歴)</span></h2>
				
				<div class="edit_btn col1 wide">
				<a href="<?php echo base_url('company/billing-history-by-day/'); ?>">売上請求へ戻る</a>
				</div>
				
				 <table class="tile many">
				 <tbody>
					 <tr>
						<th class="r5">売上<br>No</th>
						<th style="width:62px">売上日時</th>
						<th style="width:88px">紹介者ID</th>
						<th>売上金額</th>
						<th class="r8" style="width:26px">削除</th>
					 </tr>
					 <?php $i = 1 ;?>
					<?php foreach($results as $value){  ?> 
					<tr>
						<td><?php echo $value['buy_id'];?></td>
						<td><?php echo $value['buy_time'];?></td>
						<td><?php echo $value['uid_name'];?></td>
						<td style="word-break: break-word;word-wrap: break-word;">¥<?php echo number_format($value['buy_price']);?></td>
						<td>
							<a rel="leanModal" href="#delete_box" class="delete" data="<?php echo $value['buy_id'];?>">
							<img src="<?php echo base_url(); ?>assets/frontend/img/trash.png" srcset="<?php echo base_url(); ?>assets/frontend/img/trash.png 1x, <?php echo base_url(); ?>assets/frontend/img/trash@2x.png 2x" alt="">
							</a>
						</td>
					 </tr>
					<?php } ?>
				 </tbody>
				 </table>
				 
					<!--モダール中身-->
					<div id="delete_box">
						<a href="#" class="modal_close"></a>
						<p class="read">本当に削除してもよろしいですか？</p>
					<form id="buy_delete" method="POST" action ="<?php echo base_url('company/delete_billing_history/'); ?>">
						<input type="hidden" name="buy_id" id="buy_id" >
						<input type="hidden" name="get_day" value="<?php echo $_GET['day'];?>" >
						<input type="hidden" name="page" value="<?php echo $this->uri->segment(3);?>" >
						<div class="btn_col">
							<p class="btn orange"><a id="delete_btn" style="cursor:pointer">削除</a></p>
							<p class="btn gray"><a class="close_popup_btn" href="" style="cursor:pointer">戻る</a></p>
						</div>
					</form>
					</div>
					<script type="text/javascript">
					$(function() {

						$( 'a[rel*=leanModal]').leanModal({
							top: 50,                     // モーダルウィンドウの縦位置を指定
							overlay : 0.5,               // 背面の透明度 
							closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
							modalparent: "#parentdiv",      // 親要素のidを追加
						});
						
						$(".delete").click(function(){
							$("#buy_id").val($(this).attr('data'));
						});

						$("#delete_btn").click(function(){
							$("#buy_delete").submit();
						});

						$('.close_popup_btn').on('click', function() {
							event.preventDefault();
							$('#lean_overlay').attr('style','display: none');
							$('#delete_box').attr('style','display: none;');
						});
					});
					
					</script>
					<!--モダール中身/ここまで-->
								 
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
</div>
