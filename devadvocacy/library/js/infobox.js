

//Ajax request to the Github API to load info about the showcases
//Current request has a rate limit of 60 requests/hr per ip address
function listInfo(){
  $('.showcase-item').each(function(){
    var url = $(this).find('.github-info').data('github');
    var a = $('<a>', {href:url})[0];

    var $this = $(this);
    $.ajax({
      method: "GET",
      url: "https://api.github.com/repos"+a.pathname,
      dataType: "json",
      success: function(data){
        var forks = data.forks_count;
        var date = new Date(data.updated_at);
        var mm = date.getMonth() +1;
        var dd = date.getDate();
        var yyyy = date.getFullYear();
        var updated = mm + '/' + dd + '/' + yyyy;
        $this.find('.featured-forks').html(forks);
        $this.find('.featured-updated').html(updated);
      }
    });

    $.ajax({
      method: "GET",
      url: "https://api.github.com/repos"+a.pathname+"/deployments",
      dataType: "json",
      success: function(data){
         var deployments = data.length;
        $this.find('.featured-deploys').html(deployments);
      }
    });
  });
}

function getInfobox() {
  var url = $('.github-info').data('github');
  var a = $('<a>', {href:url})[0];
  var pathname = a.pathname;
  var token = "0fa278f898415de326b7925bdae042d58feb3ef2";
  var baseUrl = "https://api.github.com/?access_token=";
  var projectRepo = pathname.split('/');
  var forkNum = "https://ghbtns.com/github-btn.html?user=ibm-cds-labs&repo="+projectRepo[2]+"&type=fork&count=true&size=large"
  $('.fork-num').attr('src', forkNum);

  $.ajax({
    method: "GET",
    url: baseUrl+token,
    dataType: "json"
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/orgs/ibm-cds-labs/repos?sort=pushed&order=desc",
    dataType: "json",
    success: function(data){
      var date = new Date(data[0].updated_at);
      var mm = date.getMonth() +1;
      var dd = date.getDate();
      var yyyy = date.getFullYear();
      var cds_updated = mm + '/' + dd + '/' + yyyy;
      var description = data[0].description;
      var name = data[0].name;
      $('.project-name').html(name);
      $('.repo-update').html(cds_updated);
      $('.cds-snippet').html(description);
    }
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos"+a.pathname,
    dataType: "json",
    success: function(data){
      var issues = data.open_issues_count;
      var language = data.language;
      var forks = data.forks_count;
      var stars = data.stargazers_count;
      var watch = data.watchers_count;
      var date = new Date(data.updated_at);
      var mm = date.getMonth() +1;
      var dd = date.getDate();
      var yyyy = date.getFullYear();
      var updated = mm + '/' + dd + '/' + yyyy;
      // var contributors = ;
      $('.git-language').html(language);
      $('.git-watch').html(watch);
      $('.git-forks').html(forks);
      $('.git-stargazers').html(stars);
      $('.git-issues').html(issues);
      $('.git-updated').html(updated);
      }
    });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos"+a.pathname+"/contributors",
    dataType: "json",
    success: function(data){
       var contributors = data.length;
      $('.git-contributors').html(contributors);
    }
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos" +a.pathname + "/branches",
    dataType: "json",
    success: function(data){
       var branches = data.length;
      $('.git-branches').html(branches);
    }
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos" +a.pathname + "/pulls",
    dataType: "json",
    success: function(data){
       var requests = data.length;
      $('.git-requests').html(requests);
    }
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos" +a.pathname + "/releases",
    dataType: "json",
    success: function(data){
       var releases = data.length;
      $('.git-releases').html(releases);
    }
  });

}




$(document).ready(function(){
  getInfobox();
  listInfo();
});
