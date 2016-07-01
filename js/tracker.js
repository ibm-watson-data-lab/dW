/**
 * Encapsulate the tracking logic
 */

//Init the piwik queue
var _paq = _paq || [];

//Asynchronous loading of the piwik tracking framework
(function() {
  var geo = null;
  var geoError = null;
  var geoLocation = false;

  if (geoLocation && navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        geo = position.coords;
      },
      function(positionError) {
        geoError = positionError;
      }
    );
  }

  var customDataFn = function() {
    var ret = '';

    if (geo) {
      ret += '&geo=' + JSON.stringify({lat: geo.latitude, long: geo.longitude});
    }
    else if (geoError) {
      ret += '&message=' + (geoError.message || 'Unable to retrieve client geo location');
    }

    if (navigator.platform) {
      ret += '&uap=' + navigator.platform;
    }

    if (navigator.userAgent) {
      ret += '&uag=' + navigator.userAgent;
    }

    //date
    var d = new Date();
    ret += '&date=' + d.getUTCFullYear() + '-' + (d.getUTCMonth() + 1) + '-' + d.getUTCDate();

    return ret;
  }
  
  var extracturl = function(url) {
    var a = document.createElement('a');
    a.href = url;
    return a.protocol + '//' + a.hostname + (a.port ? (':' + a.port) : '');
  }

  var configureTracker = function(trackerUrl, siteid) {
    _paq.push(['addTracker', trackerUrl, siteid]);
    // _paq.push(['setSiteId', siteid]);
    // _paq.push(['setTrackerUrl', trackerUrl]);
    _paq.push(['addPlugin', 'cds_custom_data', {
      'link': customDataFn,
      'sitesearch': customDataFn,
      'log': customDataFn
    }]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
  }

  var addPiwikScriptTag = function(src) {
    var index = src ? src.lastIndexOf('/') : -1;
    var scriptSrc = index === -1 ? (src || '') : src.substr(0, index);

    var g = document.createElement('script');
    g.type='text/javascript';
    g.defer = true;
    g.async = true;
    g.src = scriptSrc +'/piwik.js';

    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(g, s);
  }
  
  //Get the site id from custom script data attribute
  var scripts = document.getElementsByTagName('script');
  var siteid = null;
  var defTrackerProtocol = 'http';
  var defTrackerHost = 'metrics-collector-ms.mybluemix.net';
  var trackerUrl = null;
  var src = null;

  if (scripts && scripts.length > 0) {
    var scriptTag = scripts[scripts.length - 1];
    siteid = scriptTag.getAttribute('siteid');
    trackerUrl = scriptTag.getAttribute('trackerurl');
    src = scriptTag.src;
  }

  if (!trackerUrl) {
    //Compute it from the current location
    if (src) {
      trackerUrl = extracturl(src) + '/tracker';
    }
    else {
      trackerUrl = defTrackerProtocol + '://' + defTrackerHost + '/tracker';
    }
  }

  if (!siteid) {
    console.warn('siteid attribute missing in the script tag for tracker.js');
  }

  //make sure piwik not already loaded
  if (typeof window.Piwik !== 'object') {
    configureTracker(trackerUrl, siteid);
    addPiwikScriptTag(src);
  }
  else {
    //make sure tracker not already configured
    var tracker = window.Piwik.getAsyncTracker(trackerUrl, siteid);
    if (!tracker
        || (tracker.getTrackerUrl() != trackerUrl
            && tracker.getSiteId() != siteid)) {

      configureTracker(trackerUrl, siteid);
    }
  }
})();

//dynamically enable link tracking starting from provided DOM Element
var enableLinkTrackingForNode = function(node) {
  var _tracker = this;
  node.find('a,area').each(function(link) {
    if (_tracker.addClickListener) {
      _tracker.addClickListener($(this)[0], true);
    }
  });
};
