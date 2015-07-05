var CLOUDANT_URL = "https://d14f43e9-5102-45bc-b394-c92520c2c0bd-bluemix.cloudant.com/dw/_all_docs?include_docs=true";

String.prototype.queryStringToJSON = String.prototype.queryStringToJSON || function ()
{	// Turns a params string or url into an array of params
	// Prepare
	var params = String(this);
	// Remove url if need be
	params = params.substring(params.indexOf('?')+1);
	// params = params.substring(params.indexOf('#')+1);
	// Change + to %20, the %20 is fixed up later with the decode
	params = params.replace(/\+/g, '%20');
	// Do we have JSON string
	if ( params.substring(0,1) === '{' && params.substring(params.length-1) === '}' )
	{	// We have a JSON string
		return eval(decodeURIComponent(params));
	}
	// We have a params string
	params = params.split(/\&(amp\;)?/);
	var json = {};
	// We have params
	for ( var i = 0, n = params.length; i < n; ++i )
	{
		// Adjust
		var param = params[i] || null;
		if ( param === null ) { continue; }
		param = param.split('=');
		if ( param === null ) { continue; }
		// ^ We now have "var=blah" into ["var","blah"]

		// Get
		var key = param[0] || null;
		if ( key === null ) { continue; }
		if ( typeof param[1] === 'undefined' ) { continue; }
		var value = param[1];
		// ^ We now have the parts

		// Fix
		key = decodeURIComponent(key);
		value = decodeURIComponent(value);
		try {
		    // value can be converted
		    value = eval(value);
		} catch ( e ) {
		    // value is a normal string
		}

		// Set
		// window.console.log({'key':key,'value':value}, split);
		var keys = key.split('.');
		if ( keys.length === 1 )
		{	// Simple
			json[key] = value;
		}
		else
		{	// Advanced (Recreating an object)
			var path = '',
				cmd = '';
			// Ensure Path Exists
			$.each(keys,function(ii,key){
				path += '["'+key.replace(/"/g,'\\"')+'"]';
				jsonCLOSUREGLOBAL = json; // we have made this a global as closure compiler struggles with evals
				cmd = 'if ( typeof jsonCLOSUREGLOBAL'+path+' === "undefined" ) jsonCLOSUREGLOBAL'+path+' = {}';
				eval(cmd);
				json = jsonCLOSUREGLOBAL;
				delete jsonCLOSUREGLOBAL;
			});
			// Apply Value
			jsonCLOSUREGLOBAL = json; // we have made this a global as closure compiler struggles with evals
			valueCLOSUREGLOBAL = value; // we have made this a global as closure compiler struggles with evals
			cmd = 'jsonCLOSUREGLOBAL'+path+' = valueCLOSUREGLOBAL';
			eval(cmd);
			json = jsonCLOSUREGLOBAL;
			delete jsonCLOSUREGLOBAL;
			delete valueCLOSUREGLOBAL;
		}
		// ^ We now have the parts added to your JSON object
	}
	return json;
};

// take a JSON document and put it in HTML as 1st child of #resources div
var renderResource = function (doc) {
  q = '<div class="col-sm-12 resource" id="'+doc._id+'">';
  q += '<h3><a href="'+doc.url+'" target="_new">'+doc.full_name+'</a></h3>';
  q += '<h4><small>'+doc.url+'</small></h4>';
  if ( doc.demourl && doc.demourl.length > 0 ) 
    q += '<div class="demo"><span class="demo-title">Demo: </span>' + 
      '<span><a href="'+doc.demourl+'" target="_new">'+doc.demourl+'</a></span></div>';

  // description 
  q += '<div class="description">';
  q += '<p><a class="btn btn-primary btn-sm collapsed" href="#desc-'+doc._id+'" data-toggle="collapse" aria-expanded="false" role="button">Description</a></p>';
  q += '<div id="desc-'+doc._id+'" class="collapse" style="height:0px">';
  q += '<div class="well">';
  q += '<div class="description-text">'+doc.description+'</div>';
  q += '<div class="facets">';
  if ( doc.topic && typeof Array.isArray(doc.topic) && doc.topic.length > 0 ) {
    for (var i in doc.topic) 
      q += '<span class="topic label label-default label-xs">'+doc.topic[i]+'</span>';
  }
  if ( doc.technologies && typeof Array.isArray(doc.technologies) && doc.technologies.length > 0 ) {
    for (var i in doc.technologies) 
      q += '<span class="technology label label-warning label-xs">'+doc.technologies[i]+'</span>';
  }
  q += '</div>'; // end facets
  q += '</div>'; // end 
  q += '</div></div>';
  
  q += '</div>';
  $('#resources').prepend(q);
}

var getDocument = function(docids, dontChangeURL, callback) {
  if ( typeof docids === "string" ) {
    d = docids;
    docids = [];
    docids.push(d);
  }
  var keys = {"keys": docids};
  var req = {
    url: CLOUDANT_URL,
    data: JSON.stringify(keys),
    dataType: "JSON",
    method: "post"
  };
  
  $.ajax(req).done(function(data) {
    if(!dontChangeURL) {
      if(data.rows && data.rows.length > 0 )  {
        var keystr = '';
        for(var i in data.rows) {
          keystr += ',' + data.rows[i].doc._id;
        }
        keystr = keystr.substring(1);
        window.location.href= window.location.pathname+'#!&keys='+keystr;      
      }
    }
    // $('#loading').hide();
    if (callback) {
      callback(null, data);
    }
  })
  .fail(function (err) {
    console.log(err);
  });
}

var submitForm = function() {
  docids = [];
  docids.push( $('#input-id').val() );

  getDocument(docids, false, function(err, data) {
    if(!data.rows || data.rows.length == 0 )  {
      html = '<div class="jumbotron"><h3>There are no results to match you search criteria. Please try again</h3></div>';
      $('#resources').html(html);
    } else {
      for (var i in data.rows) {
        renderResource( data.rows[i].doc );
      }
    }
  });
  return false;
}

// on load
var firsttime=true;
var onload = function() {
  if(firsttime==false) 
    return
  firsttime=false;

  $('#input-id').val('');
  
  // parse the query string
  var hash = location.hash;
  if (hash) {
    hash = hash.replace(/^#!/,""); // strip bits
    hash = hash.queryStringToJSON();
    if ( hash.keys && hash.keys.length > 0 ) {
      keys = hash.keys.split(',');
      getDocument(keys, false, function(err, data) {
        if(!data.rows || data.rows.length == 0 )  {
          html = '<div class="jumbotron"><h3>There are no results to match you search criteria. Please try again</h3></div>';
          $('#resources').html(html);
        } else {
          for (var i in data.rows) {
            renderResource( data.rows[i].doc );
          }
        }
      });
    }
  }
}
$(document).ready(onload);
