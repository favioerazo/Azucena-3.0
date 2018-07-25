$(function(){
  $(".btn").on("click",function(){
    $.notify({
      title: '<strong>好標題</strong>',
      icon: 'glyphicon glyphicon-star',
      message: "飛進來了!"
    },{
      type: 'info',
      animate: {
		    enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
    });
  });
});