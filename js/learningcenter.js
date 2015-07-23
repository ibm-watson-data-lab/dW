var parentel = $('li.current_page_parent>span>a');
var parentname = parentel.text().trim();
$('header').prepend('<div class="learning-center-name">'+parentname+'</div>');
