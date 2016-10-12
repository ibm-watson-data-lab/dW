var SITE_URL = "https://developer.ibm.com/clouddataservices2"; //"http://localhost/wordpress";//
var BASE_URL = "https://d14f43e9-5102-45bc-b394-c92520c2c0bd-bluemix.cloudant.com/devcenter/_design/search/_search/search?q=";
var generatedSearchString = "";
var filterUrl = "";
var facetString = "";

var facets = [];

var paging = {
  bookmarks: [],
  hasMore: false,
  limit: 20
}


function DropDown(el) {
  this.dd = el;
  this.placeholder = this.dd.children('span');
  this.opts = this.dd.find('ul.dropdown');
  this.val = '';
  this.index = -1;
  this.delete = $('.delete');
  this.initEvents();
}

DropDown.prototype = {
  initEvents: function() {

    this.dd.on('click', function(event) {
      $(event.currentTarget).toggleClass('active');
      return false;
    });

    this.opts.on('click', 'li', function() {
      var self = $(this);
      var found = facets.some(function(el) {
        return el.key === self.text() && el.value === self.data().count;
      });

      if(!found) {
        facets.push({
          value: self.text(),
          key: self.data().count
        });
        buildFilterQuery();
        addFacetTags();
      }
    });
  },
  getValue : function() {
    return this.val;
  },
  getIndex : function() {
    return this.index;
  }
}


//gives dynamically generated categories list reqs for search
//same reqs as facets on search tray and home page
function catToFacet(){
  $('.cat-item').addClass("blog-category");
  $('.cat-item a').attr("href", "#");

  $('li.blog-category').on('click', function(e){
    e.preventDefault();
    var val = $(this).children('a').html();
    if(val.length > 0) {
      createSearchTextQuery(val);
    } else {
      initSearch();
    }
    clearFacets();
  });
}

function facetSearchClick() {
  $("li.facet").on("click", function(e) {
    e.preventDefault();
    var self = $(this);
    var text = $(this).children('a').html();
    var found = facets.some(function(el) {
      return el.key === text && el.value === self.data().count;
    });

    if(!found) {
      facets.push({
        value: self.text(),
        key: self.data().count
      });
      buildFilterQuery();
      addFacetTags();
    }
  });
}

function addFacetTags() {
  if ($('.query_selections').find('.selection').length) {
    $('.query_selections').empty();
  }
  facets.map(function(el) {
    return (
      $('.query_selections').append(
        '<div class="selection" data-item="' + el.value + '">' +
          '<span>' + el.value + '</span>' +
          '<a href="#">' +
            '<div class="delete" data-delete="' + el.value + '" data-count="' + el.key + '"></div>' +
          '</a>' +
        '</div>'
      )
    );
  });
  deleteSearchTag();
}

// getSelections()
// this function makes an initial request when the site loades to grab all the
// search results and counts to populate the Search resouces tray and search
// result page
function getSelections() {
  $.getJSON(BASE_URL + "*:*&limit=0&counts=[%22topic%22,%22technologies%22,%22languages%22]",
    function(data){

      populateFilterDropdowns(data);
      updateTrayFacets(data);

      var languages = data.counts.languages;
      var languages_sort = Object.keys(languages).sort(function(a,b) {
        return languages[b]-languages[a];
      });

      var top_languages = languages_sort.slice(0, 7);
      for (var lang in top_languages) {
        $('.resource-links > .language-links').append('<li class="facet" data-count="languages"><a href="#">' + top_languages[lang] + '</a></li>');
        $('.navigation-main .search-submenu .sub-menu').append('<li class="facet" data-count="languages"><a href="#">' + top_languages[lang] + '</a></li>');
      }

      var technologies = data.counts.technologies;
      var technology_sort = Object.keys(technologies).sort(function(a,b) {
        return technologies[b] - technologies[a];
      });

      var top_technologies = technology_sort.slice(0, 7);
      for(var tech in top_technologies) {
        $('.resource-links > .technology-links').append('<li class="facet" data-count="technologies"><a href="#">' + top_technologies[tech] + '</a></li>');
        $('.navigation-main .search-submenu .sub-menu').append('<li class="facet" data-count="technologies"><a href="#">' + top_technologies[tech] + '</a></li>');
      }

      var topics = data.counts.topic;
      var topic_sort = Object.keys(topics).sort(function(a,b){
        return topics[b] - topics[a];
      });

      var top_topics = topic_sort.slice(0, 7);
      for(var topic in top_topics) {
        $('.resource-links > .topic-links').append('<li class="facet" data-count="topic"><a href="#">' + top_topics[topic] + '</a></li>');
        $('.navigation-main .search-submenu .sub-menu').append('<li class="facet" data-count="topic"><a href="#">' + top_topics[topic] + '</a></li>');
      }
  }).done(function() {
    facetSearchClick();
  });

}

function updateTrayFacets(data) {

  $("#language > ul").empty();
  var languages = data.counts.languages;
  var languages_sort = Object.keys(languages).sort(function(a,b) {
    return languages[b]-languages[a];
  });
  var top_languages = languages_sort.slice(0, 7);
  for (var i in top_languages) {
    $('#language > ul').append('<li class="facet" data-count="languages"><a href="#">' + top_languages[i] + '</a></li>');
  }

  $("#technology > ul").empty();
  var technologies = data.counts.technologies;
  var technology_sort = Object.keys(technologies).sort(function(a,b) {
    return technologies[b] - technologies[a];
  });

  var top_technologies = technology_sort.slice(0, 7);
  for(var tech in top_technologies) {
    $('#technology > ul').append('<li class="facet" data-count="technologies"><a href="#">' + top_technologies[tech] + '</a></li>');
  }


  $("#topic > ul").empty();
  var topics = data.counts.topic;
  var topic_sort = Object.keys(topics).sort(function(a,b){
    return topics[b] - topics[a];
  });

  var top_topics = topic_sort.slice(0, 7);
  for(var topic in top_topics) {
    $('#topic > ul').append('<li class="facet" data-count="topic"><a href="#">' + top_topics[topic] + '</a></li>');
  }
}



// populateFilterDropdowns(data);
// data: A response object received after each search.
// Populates and updates the Filter Dropdowns on the Search Results page
// each time a search is performed
function populateFilterDropdowns(data) {

  var languages = data.counts.languages;

  $(".selection").each(function() {
    delete languages[$(this).data("item")];
  });

  $('.dropdown.language').empty();
  $.each(languages, function(language) {
    var each_language = '<li data-count="languages">' + language + '</li>';
    $('.dropdown.language').append(each_language);
  });

  var technologies = data.counts.technologies;

  $(".selection").each(function() {
    delete technologies[$(this).data("item")];
  });

  $('.dropdown.technology').empty();
  $.each(technologies, function(technology) {
    var each_tech = '<li data-count="technologies">' + technology + '</li>';
    $('.dropdown.technology').append(each_tech);
  });

  var topics = data.counts.topic;

  $(".selection").each(function() {
    delete topics[$(this).data("item")];
  });

  $('.dropdown.topic').empty();
  $.each(topics, function(topic) {
    var each_topic = '<li data-count="topic">'+topic+'</li>';
    $('.dropdown.topic').append(each_topic);
  });

}


// deleteSearchTag()
// When a user removes a seleceted filter/facet update the facets array
function deleteSearchTag() {
  $('.search-tool .delete').on('click', function(e) {
    e.preventDefault();
    var deleteItem = $(this).data('delete');
    var deleteCount = $(this).data('count');
    var deleteTag = $(this).closest('.selection').data('item');

    for(var i = facets.length - 1; i >= 0; i--) {
      if(facets[i].key === deleteCount && facets[i].value === deleteItem) {
        facets.splice(i, 1);
      }
    }

    if (deleteTag === deleteItem) {
      $(this).closest('.selection').remove();
    }
    buildFilterQuery();
  });
}

function closeTray() {
  if($('.tray').hasClass('open')) {
    $('.navigation-main a').removeClass('active');
    $('.tray-container').removeClass('current-tray')
    $('.tray').removeClass('open').addClass('animated fadeOut').on( 'animationend', function() {
      $(this).removeClass( 'animated fadeOut' );
    });
  } else {
    return false;
  }
}

// getSearchString()
// When the search form is submitted, get the input value and pass to
// createSearchTextQuery() to generate url query to search results.
var freeTextString = "";
function getSearchString() {
  $('#search-cloudant, #search-form-tray').submit(function(e) {
    e.preventDefault();
    var val = $(this).closest('form').find('input[name=search]').val();

    createSearchTextQuery(val);
    if(val.length > 0) {
      $(this).closest('form').find('input[name=search]').val();
    }
  });
}

// buildFilterURL()
// generates a URL friendly search string for facets/text
function buildFilterQuery() {
  facetString = facets.map(function(el) {
    return "%7B%22key%22%3A%22" + el.key + "%22%2C%22value%22%3A%22" + el.value.split(" ").join("%20") + "%22%7D";
  }).join("%2C");
  if(facets.length > 0) {
    filterUrl = "&filter=" + "%5B" + facetString + "%5D";
  } else {
    filterUrl = "";
  }
  buildUrlParam();
}



// If there are facets/filters selected, clear them when needed
function clearFacets() {
  if(facets.length > 0) {
    facets = [];
    $('.query_selections').empty();
    buildFilterQuery();
  }
}

// createSearchString()
// Build the search request string for AJAX request.
function createSearchString() {
  var stdpart = '&limit=' + paging.limit + '&counts=["topic","technologies","languages"]&include_docs=true';
  var namespacepart = '+AND+namespace:\'Cloud+Data+Services\'';
  if(freeTextString.length <= 0 && facetString.length > 0) {
    generatedSearchString = BASE_URL + '*:*' + namespacepart + '+AND+' + facetString + stdpart + '&sort=["-date"]';
  } else if(freeTextString.length > 0 && facetString.length <= 0) {
    generatedSearchString = BASE_URL + freeTextString + namespacepart + stdpart;
  } else if(freeTextString.length > 0 && facetString.length > 0) {
    generatedSearchString = BASE_URL + freeTextString + namespacepart + '+AND+' + facetString + stdpart;
  }
  searchRequest();
}

var freeTextUrl = ""
// createSearchTextQuery(string)
// freeText: search input field value
// generates a URL friendly search string for search text
function createSearchTextQuery(freeText) {
  freeTextUrl = freeText ? ("searchText=" + freeText.split(' ').join('%20')) : '';
  buildUrlParam();
}

// buildUrlParam()
// based on suplied search criteria build a URL friendly search query
function buildUrlParam() {
  var urlQuery = '';
  if(freeTextUrl.length <= 0 && filterUrl.length > 0) {
    urlQuery = filterUrl;
  } else if(freeTextUrl.length > 0 && filterUrl.length <= 0) {
    urlQuery = freeTextUrl;
  } else if(freeTextUrl.length > 0 && filterUrl.length > 0) {
    urlQuery = freeTextUrl + filterUrl;
  } else if(freeTextUrl.length <= 0 && filterUrl.length <= 0) {
    urlQuery = "";
  }
  updateLocation(urlQuery);
}

// updateLocation(urlQuery : string)
// urlQuery: the generate url paramaters
// Updates the current url to match the generated search query
function updateLocation(urlQuery) {
  if(urlQuery.length > 0) {
    document.location.href = SITE_URL + "/how-tos/#!" + urlQuery
    parseUrl.decodeUrlQuery();
    closeTray();
  } else {
    document.location.href = SITE_URL + "/how-tos/#";
    initSearch();
  }
}

//Below code used for testing search on project developer's local environment

// function updateLocation(urlQuery) {
//   if(urlQuery.length > 0) {
//     document.location.href = "http://developer.ibm.dev/clouddataservices/search-results/#!" + urlQuery
//     parseUrl.decodeUrlQuery();
//     closeTray();
//   } else {
//     document.location.href = "http://developer.ibm.dev/clouddataservices/search-results/#";
//     initSearch();
//   }
// }


var parseUrl = {
  decodeUrlQuery: function() {
    var url = window.location.hash.slice(2);
    var paramaters = url.split("&");
    var searchparam = null;
    var filterparam = null;

    paramaters.map(function(el) {
      if (el.substr(0, el.indexOf("=")) === "searchText") {
        $('input[name=search]').val(el.substr(el.indexOf("=")+1).split("%20").join(" "));
        searchparam = el.substr(el.indexOf("=") + 1);
      }
      if (el.substr(0, el.indexOf("=")) === "filter") {
        filterparam = el.substr(el.indexOf("=") + 1);
      }
    });

    this.searchParam(searchparam, !filterparam);
    this.filterParams(filterparam);

    addFacetTags();
  },
  searchParam: function(request, dosearch) {
    if (request) {
      var searchText = request.split('%20');
      freeTextString = searchText.join('+');
      if (dosearch) {
        createSearchString();
      }
    }
  },
  filterParams: function(request) {
    if (request) {
      var filterArray = decodeURI(request);
      var firstFilter = filterArray.replace(/%3A/g, ":");
      var secondFilter = firstFilter.replace(/%2C/g, ",");
      facets = JSON.parse(secondFilter)
      this.getFacetString();
    }
  },
  getFacetString: function() {
    facetString = facets.map(function(el) {
      return el.key + ':' + '"' + el.value + '"';
    }).join("+AND+");
    createSearchString();
  }
}





// initSearch()
// Make the initial search when a user navigates to the search page
function initSearch() {
  var url = window.location.hash.slice(2);
  if($('#is-search-results-page').length > 0) {
    parseUrl.decodeUrlQuery();
  }
  if(url <= 0) {
    generatedSearchString = BASE_URL + '*:*&limit=' + paging.limit + '&counts=["topic","technologies","languages"]&include_docs=true&sort=["-date"]';
    searchRequest();
  }
}


// Make a search Request Based on user provided results
function searchRequest(searchString) {
  $('.total-count').html('Searching...');
  $('.results-content').html('<div class="searching">&#8978;</div>')

  if (!searchString || searchString.indexOf('bookmark=') === -1) {
    paging.bookmarks = [];
  }

  $.getJSON(searchString || generatedSearchString, function(data) {
    var searchResults = data.rows;
    var searchCount = searchResults.length;
    var total = data.total_rows;

    if (data.bookmark) {
      paging.bookmarks.push(data.bookmark);
    }

    if (typeof _paq !== 'undefined') {
      _paq.push(['trackSiteSearch', freeTextString, JSON.stringify(facets), data ? (total || 0) : 0]);
    }

    $('.results-content').empty();

    searchResults.map(function(el) {
      return (
        $('.results-content').append(
          '<div class="result clearfix">' +
            '<div class="title"><a href="' + el.doc.url + '">' + el.doc.name + '</a></div>' +
            '<p class="snippet">' + el.doc.description + 
            ' <span class="hiddeneditor"><a href="https://devcenter.mybluemix.net/doc?id=' + el.doc._id + '" target="_blank"><img src="../wp-content/themes/devadvocacy/library/images/next-arrow.png" height="12"></a></span>' + '</p>' +
            '<a href="' + el.doc.url + '">' + el.doc.url + '</a>' +
          '</div>'
        )
      );
    });
    populateFilterDropdowns(data);
    updatePaging(data);
    // updateTrayFacets(data);
  });
}

function initPaging() {
  $('.results-paging-prev')
    .on('click', function() {
      if (paging.bookmarks.length > 1) {
        paging.bookmarks.splice(-2, 2);
        if (paging.bookmarks.length > 0) {
          var bookmark = paging.bookmarks[paging.bookmarks.length - 1];
          searchRequest(generatedSearchString + '&bookmark=' + bookmark);
        }
        else {
          searchRequest();
        }
      }
    });
  $('.results-paging-next')
    .on('click', function() {
      if (paging.bookmarks.length > 0 && paging.hasMore) {
        var bookmark = paging.bookmarks[paging.bookmarks.length - 1];
        searchRequest(generatedSearchString + '&bookmark=' + bookmark);
      }
    });
}

function updatePaging(data) {
  var page = paging.bookmarks.length - 1;
  var total = data.total_rows;

  var start = (page * paging.limit) + 1;
  var end = start + paging.limit - 1;

  if (start < 1) {
    start = 1;
  }

  if (total < 1) {
    start = 0;
  }

  if (end > total) {
    end = total;
  }

  if (start > end) {
    end = start;
  }

  paging.hasMore = data.total_rows > (paging.bookmarks.length * (paging.limit ? paging.limit : 1));
  $('.results-paging-next').css('display', end >= total ? 'none' : 'inline-block');
  $('.results-paging-prev').css('display', start <= 1 ? 'none' : 'inline-block');

  $('.total-count').html('Showing <span>' + start + ' - ' + end + '</span> of <span>' + total + '</span> search results');
}



$(document).ready(function(){
  getSelections();
  initSearch();
  getSearchString();
  catToFacet();
  initPaging();
  new DropDown($('.filter'));
});
