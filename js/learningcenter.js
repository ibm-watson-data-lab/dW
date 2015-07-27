var pathname = window.location.pathname;
if (pathname.startsWith('/clouddataservices/docs/dashdb/') ) 
  $('.learning-center-name').append('dashDB Learning Center');
else if (pathname.startsWith('/clouddataservices/docs/cloudant/') ) 
  $('.learning-center-name').append('<div class="learning-center-name">Cloudant Learning Center</div>');

// add static menu
if ( $('.learning-center-menu') ) {
  var h = '<ul>'
  h += '<li><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.kc.doc/welcome.html">Docs</a></li>';
  h += '<li><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.doc/tutorial/tutorials_overview.html">Tutorials</a></li>';
  h += '<li><a href="./how-tos/#&amp;filter=[{%22key%22%3A%22technology%22%2C%22value%22%3A%22dashDB%22}]">How-Tos</a></li>';
  h += '</ul>';

  $('.learning-center-menu').append(h);
}
