//new instance of the Dropdown filter
function eventFilter(el) {
  this.dd = el;
  this.placeholder = this.dd.find('span');
  this.opts = this.dd.find('ul.dropdown');
  this.val = '';
  this.index = -1;
  this.initEvents();
  this.getSelected();
}

eventFilter.prototype = {
  initEvents : function() {
    var obj = this;
    var events_number = $('.event-content').length;
    $('.total-events > span').html(events_number);

    obj.dd.on('click', function(event){
      $(event.currentTarget).toggleClass('active');
      return false;
    });
  },

  getSelected: function(){
    var obj = this;
    obj.opts.on('click', 'li', function(){
      var opt = $(this);
      obj.val = opt.text();
      obj.region = opt.data("region");
      obj.scope = opt.data("scope");
      obj.index = opt.index();
      obj.placeholder.text(obj.val);
      if($(opt).hasClass("region-item")){
        filterRegion(obj.region);
      }
      else{
        filterScope(obj.scope);
      }
    });

    function filterRegion(selected){
      $('.event-content').fadeOut("fast")
        .removeClass('selected')
        .filter('[data-region*="' + selected + '"]')
        .addClass('selected')
        .fadeIn("fast");
        var events_number = $('.selected').length;
        $('.total-events > span').html(events_number);
    }

    function filterScope(selected){
      $('.event-content').fadeOut("fast")
        .removeClass('selected');
        $('.event-content').each(function() {
          var event_scope =$(this).data("scope");
          if(event_scope < selected) {
            $(this).addClass('selected')
            .fadeIn("fast");
            var events_number = $('.selected').length;
            $('.total-events > span').html(events_number);
          }
      });
    }
  }
}

$(document).ready(function(){
  new eventFilter($('.region-filter'));
  new eventFilter($('.scope-filter'));

});
