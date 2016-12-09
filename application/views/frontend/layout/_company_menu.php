
<link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/all.min.css') ?>" />
<a class="menu_btn"></a>
<div class="drawr">
<ul class="menu">
<?php
	if(check_support($this->session->userdata['id']) == 0){
?>
<li><a rel="activeFlag" href="#acive-flag" >応援サービス登録</a></li>
<?php
	}else{
?>
<li><a  href="<?php echo base_url('company/regist-purchase'); ?>" >応援サービス登録</a></li>
<?php } ?>
<li><a href="<?php echo base_url('company'); ?>">マイページ</a></li>
<li><a href="<?php echo base_url('company/billing-history-by-day'); ?>">売上請求照会</a></li>
<li><a rel="leanModal" href="#change-password">パスワード再発行</a></li>
<!-- <li><a href="<?php echo base_url('company'); ?>">利用規約</a></li> -->
<li><a href="<?php echo base_url('cross-infinity-information'); ?>">CROSS INFINITY情報</a></li>
<li><a href="<?php echo base_url('logout'); ?>">ログアウト</a></li>
</ul>
</div>

<div id="test-modal" class="mfp-hide white-popup-block">
	<center>
	<br>
	<h1 style="line-height:28px;color:#ea8d5b">ただいま実装中。<br>Coming soon!!</h1>
	<br>
	</center>
	
	<button title="Close (Esc)" type="button" class="mfp-close phuc-close">Close</button>
</div>


<div id="change-password" style="display:none">
	<a href="#" class="modal_close"></a>
	<p style="text-align: center; margin-top: 20px;"><b>企業情報変更パスワードを</b></p>
	<p style="text-align: center;"><b>入力して下さい。</b></p>
	<form id="menu_confirm_password" method="POST" action ="<?php echo base_url('company/support/'); ?>">
		<div style="text-align: center; margin-top: 15px;">
			
			<input type="password" name="password_confirm" class="" id="password_confirm" autofocus/>
			<input type="hidden" name="is_check_password" value="true"/>
			
		</div>
		<div class="btn_col">
			<p class="btn orange"><a id="close_button" style="cursor:pointer; background-color: #b8b8b8;">戻る</a></p>
			<p class="btn gray"><a id="menu_confirm_btn" style="cursor:pointer; background-color: #ea8d5b;">確認</a></p>
		</div>
	</form>
</div>

<div id="acive-flag" style="display:none">
	<a href="#" class="modal_close"></a>
	<p style="text-align: center;"><b>対象の応援サービスがありません。</b></p>
</div>

<style type="text/css">
	#change-password{
		background-color: #fff;
	    border-radius: 5px;
	    display: none;
	    padding: 10px;
	    width: 290px;
	    height: 196px;
	}
	#change-password .modal_close, #acive-flag .modal_close{
		position: absolute;
		top: 12px;
		right: 12px;
		display: block;
		z-index: 2;
		background: url("<?php echo base_url('assets/frontend/'); ?>/img/close.png") no-repeat top left;
		width: 22px;
		height: 22px;
	}
	#change-password p.read{
		font-weight:bold;
		font-size:14px;
		position: absolute;
		top: 75px;
		left:40px;
	}
	#change-password div.btn_col {
		position: absolute;
		bottom: 0;
		left:10px;
		overflow:hidden;
	}

	#change-password div.btn_col p.btn{
		float:left;
	}
	#change-password div.btn_col p.btn a{
		width:140px;
	}
	#change-password div.btn_col p.btn.orange a{
		margin-right:10px;
	}
	#acive-flag{
	    background: #fff;
	    width: 260px;
	    height: 90px;
	    border-radius: 5px;
	    text-align: center;
	    padding: 3px 10px;
	}
	#acive-flag p{
		margin-top: 40px;
		font-size: 16px;
		color: #FB0E0E;
	}
</style>

<script type="text/javascript">
$(function() {
		$('a[rel*=leanModal]').leanModal({
			top: 50,                     // モーダルウィンドウの縦位置を指定
			overlay : 0.5,               // 背面の透明度 
			closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
			modalparent: "#parentdiv",      // 親要素のidを追加
		});

		$('a[rel*=activeFlag]').leanModal({
			top: 50,                     // モーダルウィンドウの縦位置を指定
			overlay : 0.5,               // 背面の透明度 
			closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
			modalparent: "#parentdiv",      // 親要素のidを追加
		});

		$('#close_button').on('click', function() {
			event.preventDefault();
			$('#lean_overlay').attr('style','display: none');
			$('#change-password').attr('style','display: none;');
		});
		$("#menu_confirm_btn").click(function(){
			event.preventDefault();
			$("#menu_confirm_password").submit();

		});
	});
</script>