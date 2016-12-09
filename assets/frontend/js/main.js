

//スムーススクロール
$(function(){
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});



//ドロワーメニュー
$(function($) {
	WindowHeight = $(window).height();
	$('.drawr');
	
	$(document).ready(function() {
		$('.menu_btn').click(function(){ //クリックしたら
			$('.drawr').animate({width:'toggle'}); //animateで表示・非表示
			$(this).toggleClass('peke'); //toggleでクラス追加・削除
		});
	});
});


//////モダールウィンドウ
// leanModal v1.1 by Ray Stone - http://finelysliced.com.au
// Dual licensed under the MIT and GPL
(function($) {
	$.fn.extend({
		leanModal: function(options) {
			var defaults = {
				top: 100,
				overlay: 0.5,
				closeButton: null
			};
			var overlay = $("<div id='lean_overlay'></div>");
			$("body").append(overlay);
			options = $.extend(defaults, options);
			return this.each(function() {
				var o = options;
				$(this).click(function(e) {
					var modal_id = $(this).attr("href");
					$("#lean_overlay").click(function() {
						close_modal(modal_id)
					});
					$(o.closeButton).click(function() {
						close_modal(modal_id)
					});
					var modal_height = $(modal_id).outerHeight();
					var modal_width = $(modal_id).outerWidth();
					$("#lean_overlay").css({
						"display": "block",
						opacity: 0
					});
					$("#lean_overlay").fadeTo(200, o.overlay);
					// 追加 ↓
					$(o.parentdiv).children().css({"display":"none"});
					// 追加 ↑
					$(modal_id).css({
						"display": "block",
						"position": "fixed",
						"opacity": 0,
						"z-index": 11000,
						"left": 50 + "%",
						"margin-left": -(modal_width / 2) + "px",
						"top": o.top + "px"
					});
					$(modal_id).fadeTo(200, 1);
					e.preventDefault()
				})
			});

			function close_modal(modal_id) {
				$("#lean_overlay").fadeOut(200);
				$(modal_id).css({
					"display": "none"
				})
			}
		}
	})
})(jQuery);

//show list in UC-08
$(document).ready(function(event) {
    $('#showmenu').click(function() {
        $('ul.second_level').toggle(0);
    });
    if(!$(event.target).hasClass('#showmenu')){
    	$('ul.second_level').hide();
    }
    $('body').click(function(e){
    	if(e.target.id != 'showmenu') {
        	$("ul.second_level").hide();   
    	}
    })
});
// $(document).click(function(e) {   
    
    
// });