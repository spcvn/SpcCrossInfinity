<link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/all.min.css') ?>" />
<a class="menu_btn"></a>
<div class="drawr">
	<ul class="menu">
		<li>
		<a href="<?php echo base_url('user'); ?>">マイページ</a>
	</li>
		<li>
		<a  href="<?php echo base_url('user/service') ?>">企業応援サービス一覧</a>

	</li>
		<li>
		<a  href="<?php echo base_url('user/edit#change-password'); ?>">パスワード再設定</a>
	</li>
		<!-- <li>
		<a  class="popup-modal" href="#test-modal">利用規約</a>
	</li> -->
		<li>
		<a  href="<?php echo base_url('cross-infinity-information'); ?>">CROSS INFINITY情報</a>
	</li>
		<li>
		<a href="<?php echo base_url('logout'); ?>">ログアウト</a>
	</li>
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