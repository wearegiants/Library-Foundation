$(function(){

	$(window).scroll(function() {
    var speed = 8.0;
    $('.membership-level').css("background position", (-window.pageXOffset / speed) + "px " + (-window.pageYOffset / speed) + "px");
  });

});