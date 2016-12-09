$(document).ready(function(){

	var page = getParameterByName('page');
	if(page > 1){
		$("a[rel='next']").addClass('next');
		$("a[rel='prev']").addClass('next');
	}

	if(page == ""){
		$("a[rel='next']").addClass('next');
	}

	//tab
	if(getParameterByName('category') != ''){
		swiper.slideTo(0,0,false);
	}
	if(getParameterByName('address') != ''){
		swiper.slideTo(1,0,false);
	}
	if(getParameterByName('station') != ''){
		swiper.slideTo(2,0,false);
	}
	if(getParameterByName('company') != ''){
		swiper.slideTo(3,0,false);
	}
	if(getParameterByName('reward-point') != ''){
		swiper.slideTo(4,0,false);
	}

	//remove input null
	$('#search').submit(function(event){
	  var cur = $(event.target);
	  var non_input = cur.find('li.swiper-slide-active').siblings();
		 $.each(non_input,function(index,value){
		 	$(value).find('input[name]').remove();
		 	$(value).find('select').remove();
		 });
	});

	//validition enter number
    $('input[type="tel"]').on('input',function(event){
        this.value = this.value.replace(/[^0-9]/g,'');
      });
});