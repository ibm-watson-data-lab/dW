var pathname = window.location.pathname;
if ( pathname.indexOf('/clouddataservices/docs/dashdb/') == 0 ) {
  $('.learning-center-name').append('dashDB Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="http://www-01.ibm.com/support/knowledgecenter/SS6NHC/com.ibm.swg.im.dashdb.kc.doc/welcome.html">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#&amp;filter=[{%22key%22%3A%22technologies%22%2C%22value%22%3A%22dashDB%22}]">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }

} else if (pathname.indexOf('/clouddataservices/docs/cloudant/') == 0 ) {
  $('.learning-center-name').append('Cloudant Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="http://docs.cloudant.com">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#&amp;filter=[{%22key%22%3A%22technologies%22%2C%22value%22%3A%22cloudant%22}]">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }

} else if (pathname.indexOf('/clouddataservices/docs/dataworks/') == 0 ) {
  $('.learning-center-name').append('DataWorks Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="https://www.ng.bluemix.net/docs/services/dataworks1/index.html">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#&amp;filter=[{%22key%22%3A%22technologies%22%2C%22value%22%3A%22DataWorks%22}]">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }  
  
} else if (pathname.indexOf('/clouddataservices/docs/spark/') == 0 ) {
  $('.learning-center-name').append('Apache Spark Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="https://www.ng.bluemix.net/docs/services/AnalyticsforApacheSpark/index.html">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#&amp;filter=[{%22key%22%3A%22technologies%22%2C%22value%22%3A%22Spark%22}]">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }  

} else if (pathname.indexOf('/clouddataservices/docs/BigInsights/') == 0 ) {
  $('.learning-center-name').append('BigInsights Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="https://www.ng.bluemix.net/docs/#services/BigInsights/index.html#biginsights">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#&amp;filter=[{%22key%22%3A%22technologies%22%2C%22value%22%3A%22BigInsights%22}]">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }  
} else if (pathname.indexOf('/clouddataservices/docs/Compose/') == 0 ) {
  $('.learning-center-name').append('Compose Learning Center');
  // add static menu
  if ( $('.learning-center-menu') ) {
    var h = '<ul>'
    h += '<li><a href="https://help.compose.io/">Docs</a></li>';
    h += '<li><a href="/clouddataservices/how-tos/#!searchText=Compose">How-Tos</a></li>';
    h += '</ul>';

    $('.learning-center-menu').append(h);
  }  

} else {
  $('.learning-center-name').append('Learning Centers');
}


