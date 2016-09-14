/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/

function updateViewportDimensions() {
  var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
  return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
window.waitForFinalEvent = (function () {
  var timers = {};
  return function (callback, ms, uniqueId) {
    if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
    if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
    timers[uniqueId] = setTimeout(callback, ms);
  };
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
window.timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *  // update the viewport, in case the window size has changed
 *  viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
  }
} // end function


/*
 * Put all your regular jQuery in here.
*/

function resetHeader() {
  if ($(window).width() > 767) {
    $('.navigation-main .main-menu').removeClass('menu-open menu-toggle sub-view');
    $('.navigation-main .main-menu li').removeClass( 'sub-view-open sub-view');
  } else {
    $('.navigation-main a').removeClass('active');
    $('.tray').removeClass('open');
    $('.tray-container').removeClass('current-tray');
  }
}

// function mobileHeader() {
//   if ($(window).width() < 768) {
//     $('.nav-trigger').off('click').on('click', function(e) {
//       e.preventDefault();
//
//       if ($('.navigation-main .main-menu').hasClass( 'menu-open' )) {
//         $('.navigation-main .main-menu').removeClass( 'menu-open' ).addClass('menu-toggle').on( 'transitionend', function() {
//           $(this).removeClass( 'menu-toggle' );
//         });
//       } else {
//         $('.navigation-main .main-menu').addClass( 'menu-open menu-toggle' ).on( 'transitionend', function() {
//           $(this).removeClass( 'menu-toggle' );
//         });
//       }
//
//       $('.navigation-main .main-menu').removeClass('sub-view');
//       $('.navigation-main .main-menu li').removeClass( 'sub-view-open sub-view');
//     });
//
//     $('.navigation-main .expanded').off('click').on('click', function(e) {
//       e.preventDefault();
//
//       $('.navigation-main .main-menu').addClass( 'sub-view ');
//       $(this).closest('li').addClass( 'sub-view-open sub-view animated fadeIn' ).on( 'animationend', function() {
//         $(this).removeClass( 'animated fadeIn' );
//       });
//     })
//
//     $('.sub-menu .back').off('click').on('click', function(e) {
//       e.preventDefault();
//
//       $('.navigation-main .main-menu').removeClass( 'sub-view ');
//       $('.navigation-main .main-menu li').removeClass( 'sub-view-open sub-view');
//       $('.navigation-main .main-menu > li').addClass( 'animated fadeIn' ).on( 'animationend', function() {
//         $(this).removeClass( 'animated fadeIn' );
//       });
//     })
//   }
// }

//Below function calls the Caroulslider plugin. It establishes basic implementation
//and sets the number of slides at various breakpoints
function carouselSlider(){
  if ($('.showcase-carousel .carousel-item').length > 3) {
    $('.showcase-carousel').slick({
      arrows: true,
      dots: false,
      slidesToShow: 4,
      infinite: true,
      responsive: [
        {
          breakpoint: 2000,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 1620,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 1105,
          settings: {
            slidesToShow: 1
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '60px'
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            initialSlide: 0,
            centerMode: true,
            centerPadding: '15px'
          }
        }

      ]
    });
  }
}

//Opens and closes Modal that list all developer advocates based on current state
//Modal is only displayed on home Blog Page
function devModal(){
  $('.blog-author .more-info').on('click', function(e){
    e.preventDefault();
    $(this).closest('.blog-content').find('.modal.author, .arrow-up').fadeToggle();
  });
}

//Opens and closes Modal that list all developer advocates based on current state
//Modal is disaplay on the both the Blog Home and Blog Single Pages
function advocateModal(){
  $('.dev-images .more-info').on('click', function(e){
    e.preventDefault();
    $(this).closest('.dev-intro').find('.modal.advocates, .arrow-up').fadeToggle();
  });
}

//Closes Any modal that has an [X] in the top right corner
function closeModal(){
  $('.modal > .exit').on('click', function(e){
    e.preventDefault();
    $(this).closest('.modal, .arrow-up').fadeOut();
  });
}

//Open the 'Powered By' modal on the search Tray
function poweredModal(){
  $('.engine-info').on('click', function(){
    $(this).closest('.topic-list').find('.modal.powered, .arrow-up').fadeToggle();
  });
}

//Adds taxonomy to the services parents and subsequent child pages in order
// to render content in the proper format
function serviceTaxonomy(){
	$('.navigation-items').children('.page_item').addClass('parent');
	$('.parent').children('a').addClass('get');
  $('.parent').children('a').attr('title', 'nav-title');
  $('.page_item_has_children').children('a').addClass('sub-nav');
	$('.sub-menu').children('a').addClass('sub-title');
	$('.sub-menu').children('.children').addClass('resources');
}

// resizes  open trays (search and services) with based on the available
// width of the viewport
function setContent(){
  if ($(window).width() > 767) {
    var header_width = $('header').width();
    var window_width = window.innerWidth;
    var tray_width = window_width - header_width;
    $('.tray, .footer').css("margin-left", header_width);
    $('.tray').css("min-width", tray_width);
		$(window).resize(function(){
      var header_width = $('header').width();
      var window_width = window.innerWidth;
      var tray_width = window_width - header_width;
      $('.content, .tray, .footer').css("margin-left", header_width);
      $('.tray').css("min-width", tray_width);
		});
  }
}

//Method adds padding and margin to the overall site if the user is logged
//into WordPress and WordPress admin bar is displayed
function wpAdminBar(){
  if($('#wpadminbar').length){
    $('#ibm-masthead').css("padding-top", "30px");
    $('.content').css('top', '48px');
    $('header').css('margin-top', '30px');
  }
}

//Removes logo located in bottom right corner of main navigation if window
//height is less than 630px
function iconRemove(){
  var height = $(window).height();
  if (height < 630){
    $('.logo').css('display', 'none');
  }
}

//functionality that displays addition post by author once clicked
//functionality exists the Developer Advocate's page (author.php)
function seeMore(){
  $('.single-post:gt(1)').hide();
  $('.more-posts span').on('click', function(){
    if($(this).hasClass('posts-open')){
      $('.single-post:gt(1)').slideUp('slow');
      $('.more-posts span').html('See More').removeClass('posts-open');
    }
    else {
      $('.single-post:gt(1)').slideDown('slow');
      $('.more-posts span').html('Show Less').addClass('posts-open');
    }
  });
}

$(document).ready(function() {
  loadGravatars();
  // mobileHeader();
  carouselSlider();
  devModal();
  advocateModal();
  poweredModal();
  closeModal();
	serviceTaxonomy();
  setContent();
  resetHeader();
  wpAdminBar();
  seeMore();
  iconRemove();
});

//   var resizeTimer;
//   $(window).on('resize', function() {
//     clearTimeout(resizeTimer);
//     resizeTimer = setTimeout(function() {
//       mobileHeader();
//     });
//   });
// });
