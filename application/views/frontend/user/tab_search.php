<!--スワイプタブ ここから-->
<div class="box">
<form action="<?php echo base_url('user/search') ?>" method="get" id="search">
<div class="swiper-container">
	<ul class="tab">
		<div class="swiper-pagination">
		</div>
	</ul>
	<ul class="swiper-wrapper content">
		<li class="swiper-slide">
			<!---->
			<div class="searchform">
				<?php
					$value_category = ($this->input->get('category') != "") ? $this->input->get('category') : NULL;
				?>
				<div class="select-style">
				<select name="category" class="keywords swiper-no-swiping">
					<option></option>
					<?php
						if($category != false){
							foreach ($category as $item) {
								$selected = ($value_category == $item->category_id ? 'selected' : '');
								echo "<option value='".$item->category_id."'".$selected." >".$item->category_name."</option>";
							}
						}
					?>
					
				</select>
				</div>
				<!-- <input name="category" class="keywords" placeholder="カテゴリ" value="<?php echo $value_category; ?>" type="text" maxlength="255" /> -->
				<input type="submit" value="検索" class="searchBtn" id="btn_category">
			</div>
			<!---->
		</li>
		<li class="swiper-slide">
			<!---->
			<div class="contents tab2">
				<div class="searchform">
					<?php
						$value_address = !empty($this->input->get('address')) ? $this->input->get('address') : NULL;
					?>
					<input name="address" class="keywords" placeholder="場所" value="<?php echo $value_address; ?>" type="text" maxlength="255" />
					<input type="submit" value="検索" class="searchBtn" id="btn_address">
				</div>
			</div>
			<!---->
		</li>
		<li class="swiper-slide">
			<!---->
			<div class="contents tab3">
				<div class="searchform">
					<?php
						$value_station = !empty($this->input->get('station')) ? $this->input->get('station') : NULL;
					?>
					<input name="station" class="keywords" placeholder="最寄駅" value="<?php echo $value_station; ?>" type="text" maxlength="255" />
					<input type="submit" value="検索" class="searchBtn" id="btn_station">
				</div>
			</div>
			<!---->
		</li>
		<li class="swiper-slide">
			<!---->
			<div class="contents tab4">
				<div class="searchform">
					<?php
						$value_company = !empty($this->input->get('company')) ? $this->input->get('company') : NULL;
					?>
					<input name="company" class="keywords" placeholder="会社名" value="<?php echo $value_company; ?>" type="text" maxlength="255" />
					<input type="submit" value="検索" class="searchBtn" id="btn_company">
				</div>
			</div>
			<!---->
		</li>
		<li class="swiper-slide">
			<!---->
			<div class="contents tab5">
				<div class="searchform">
					<?php
						$value_reward_point = !empty($this->input->get('reward-point')) ? $this->input->get('reward-point') : NULL;
						$value_reward = !empty($this->input->get('reward')) ? $this->input->get('reward') : NULL;
					?>
					<div class="tab-point">
						<input name="reward-point" class="keywords" placeholder="応援ポイント" value="<?php echo $value_reward_point; ?>" type="tel" maxlength="20" />
						<div class="select-style">
							<select class="keywords swiper-no-swiping" name="reward">
								<option value="pt">pt</option>
								<option value="rate" <?php echo $value_reward == 'rate' ? 'selected' : "";  ?>>％</option>
							</select>
							
						</div>
					</div>
					<input type="submit" value="検索" class="searchBtn" id="btn_reward-point">
				</div>
			</div>
			<!---->
		</li>
	</ul>
</div>
</form>
</div>
<!-- Swiper JS -->
<script src="<?php echo base_url('/assets/frontend/js/swiper.js'); ?>"></script>
<script>
var swiper = new Swiper('.swiper-container', {
	pagination: '.swiper-pagination',
	slidesPerView: 1,
	paginationClickable: true,
	calculateHeight: true,
	spaceBetween: 30,
	paginationClickable: true,
	paginationBulletRender: function (index, className) {
		return '<li class="'+className+'"></li>';
	}    });
	
</script>
<!--スワイプタブ ここまで-->
