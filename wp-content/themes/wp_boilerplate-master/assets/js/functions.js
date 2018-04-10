jQuery(document).ready( function($) {


  var scroll_pos = 0;
  $(document).scroll(function() {
    scroll_pos = $(this).scrollTop();
    if(scroll_pos < 100) {
      $('.sofa div.img').addClass('green');
    }
    if (scroll_pos > 400) {
      $('.sofa div.img').removeClass('green');
    }
    scroll_pos = $(this).scrollTop();
    if(scroll_pos < 400) {
      $('.sofa div.img').addClass('orange');
    }
    if (scroll_pos > 700) {
      $('.sofa div.img').removeClass('orange');
    }
    scroll_pos = $(this).scrollTop();
    if(scroll_pos < 700) {
      $('.sofa div.img').addClass('pink');
    }
    if (scroll_pos > 1000) {
      $('.sofa div.img').removeClass('pink');
    }
    scroll_pos = $(this).scrollTop();
    if(scroll_pos < 1000) {
      $('.sofa div.img').addClass('blue');
    }
  });


    $('.texto').hide();
    $('.bg_envio').hover(function(){
      $('.texto').toggle();
    })
    $('.texto2').hide();
    $('.bg_pedido').hover(function(){
      $('.texto2').toggle();
    })
    $('.texto3').hide();
    $('.bg_recepcion').hover(function(){
      $('.texto3').toggle();
    })
    $('.texto4').hide();
    $('.bg_transporte').hover(function(){
      $('.texto4').toggle();
    })

//ancla
  $('a[href^="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });

});
