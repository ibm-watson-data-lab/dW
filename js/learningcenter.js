var pathname = window.location.pathname;
// this will only exist on pages with a parent docs page
// var parentel = $('ul.pn-nav-tree>li.is-open>span>a');
// if ( parentel.length>0 ) {
//   var parentname = parentel.text().trim();
//   $('header').prepend('<div class="learning-center-name">'+parentname+'</div>');
// }
if (pathname.startsWith('/clouddataservices/docs/dashdb/') ) 
  $('header').prepend('<div class="learning-center-name">dashDB Learning Center</div>');

// add static menu
if ( $('#dashdb-menu') ) {
  var h = '<div class="btn-group" role="group">'
  h += '<div class="btn btn-default"><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.kc.doc/welcome.html">Docs</a></div>';
  h += '<div class="btn btn-default"><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.doc/tutorial/tutorials_overview.html">Tutorials</a></div>';
  h += '<div class="btn btn-default"><a href="./how-tos/#&amp;filter=[{%22key%22%3A%22technology%22%2C%22value%22%3A%22dashDB%22}]">How-Tos</a></div>';
  h += '</div>';

  $('#dashdb-menu').append(h);
}
