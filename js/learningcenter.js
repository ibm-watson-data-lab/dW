// this will only exist on pages with a parent docs page
// var parentel = $('li.current_page_parent>span>a');
var parentel = $('ul.pn-nav-tree>li.is-open>span>a');
if ( parentel ) {
  var parentname = parentel.text().trim();
  $('header').prepend('<div class="learning-center-name">'+parentname+'</div>');
}

// add static menu
// var pathname = window.location.pathname;
// if (pathname.startsWith('/clouddataservices/docs/dashdb/') ) {
if ( $('#dashdb-menu') ) {
  var h = '<div class="btn-group" role="group">'
  h += '<div class="btn btn-default"><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.kc.doc/welcome.html">Docs</a></div>';
  h += '<div class="btn btn-default"><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.doc/tutorial/tutorials_overview.html">Tutorials</a></div>';
  h += '<div class="btn btn-default"><a href="./how-tos/#&amp;filter=[{%22key%22%3A%22technology%22%2C%22value%22%3A%22dashDB%22}]">How-Tos</a></div>';
  h += '</div>';

  $('#dashdb-menu').append(h);
}
