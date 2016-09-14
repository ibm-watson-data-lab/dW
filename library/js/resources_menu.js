
function menuState() {
  $(document).on('click', function(){
    $('.filter').removeClass('active');
    $('.region-filter').removeClass('active');
    $('.scope-filter').removeClass('active');
  });
}

function removeClick(){
  var $j = jQuery.noConflict();
  $j("li:has(ul)").children("a").click(function () {
    return false;
  });
}



$(document).ready(function(){
  menuState();
  removeClick();
});
