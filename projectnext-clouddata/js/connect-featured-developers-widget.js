(function($){

  // function to modify the output string for select2 options
  function featured_devs_format(item) {
	return item.avatar + ' ' + item.text + ( item.nickname ? ' &ldquo;' + item.nickname +  '&rdquo;' : '' );
  }

  function init() {
    $('input[type="hidden"][name$="[devs]"]')
    .not('[name$="[__i__][devs]"]') // exclude the "__i__" initial widget
    .each(function( i, el ){
    
	  $input = $(el)
	
	  if ( $input.data().select2 ) { 
		console.log( 'bailed on: ' )
		console.log($input.attr('id'))
		return;
	  }
	
	  $input.select2({
		data: { results: window.site_users },
		formatSelection: featured_devs_format,
		formatResult: featured_devs_format,
		multiple: true,
		placeholder: 'start typing a name',
		maximumSelectionSize: 10
	  });
	  
	  // make the Featured Developers sortable
	  // see: http://ivaynberg.github.io/select2/#sort_results
	  $input
		.select2("container")
		.find("ul.select2-choices")
		.sortable({
		  containment: 'parent',
		  start: function() { $input.select2("onSortStart"); },
		  update: function() { $input.select2("onSortEnd"); }
		});
	
	});
  }
  
  // Run when document ready for the initial load
  $(document).ready( init );
  
  // And re-init things when a widget is saved
  // This happens for new widgets and when you save existing ones
  // You're checking the settings data for signs that you've manipulated one of your widgets
  $(document).on( 'ajaxSuccess', function(e, xhr, settings) {
    
    var widget_id_base = 'pnext_connect_featured_developers',
    	go = settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1;
    
    go && init();
    
  });

})(jQuery)