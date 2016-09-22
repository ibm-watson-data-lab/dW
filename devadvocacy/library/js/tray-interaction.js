
function trayState() {
  if ($(window).width() > 767) {
    $('.navigation-main .expanded').off('click').on('click', function(e) {
      e.preventDefault();
      if ($(this).hasClass('expanded') && $(this).hasClass('active')) {
        $(this).removeClass('active')
      } else {
        $('.navigation-main a').removeClass('active');
        $(this).addClass('active');
      }

      var target = '.' + $(this).data('target');
      if (!$('.tray').hasClass('open')){ // opens navigation tray and corresponding tab
        $('.tray-container').removeClass('current-tray')
        $('.tray').addClass('open animated fadeIn').on( 'animationend', function() {
          $(this).removeClass('fadeIn');
        });
        $(target).addClass('current-tray')
      } else if ($('.tray').hasClass('open') && $(target).hasClass('current-tray')) { // closing tray from navigation
        $('.tray').removeClass('open').addClass('animated fadeOut').on( 'animationend', function() {
          $(this).removeClass( 'animated fadeOut' );
        });
        $('.tray-container').removeClass('current-tray')
      } else { // switching between navigation tab when tray is open
        $('.tray-container').removeClass('current-tray')
        $(target).addClass('animated fadeIn current-tray').on( 'animationend', function() {
          $(this).removeClass( 'animated fadeIn' );
        });
      }
    });
  }
}

function closeBtn(){
  if ($(window).width() > 767) {
    $('.close').off('click').on('click', function(e){
      e.preventDefault();
      $('.navigation-main a').removeClass('active');
      $('.tray-container').removeClass('current-tray')
      $('.tray').removeClass('open').addClass('animated fadeOut').on( 'animationend', function() {
        $(this).removeClass( 'animated fadeOut' );
      });
    });
  }
}

$(document).ready(function(){
  trayState();
  closeBtn();

  var resizeTimer;
  $(window).on('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      trayState();
      closeBtn();
    }, 100);
  });
});
