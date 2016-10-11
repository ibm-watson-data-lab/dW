var GH_TOKEN = "290f1461867d4e60fb9f28b4574bac15dc0b5753" //"56d1f579c05fcc76bb082b6459b7bd548c37b9ca";// "0fa278f898415de326b7925bdae042d58feb3ef2";


//Ajax request to the Github API to load info about the showcases
//Current request has a rate limit of 60 requests/hr per ip address
function listInfo(){
  $('.showcase-item').each(function(){
    var url = $(this).find('.github-info').data('github');
    var a = $('<a>', {href:url})[0];

    var $this = $(this);
    $.ajax({
      method: "GET",
      url: "https://api.github.com/repos"+a.pathname+"?access_token="+GH_TOKEN,
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
      url: "https://api.github.com/repos"+a.pathname+"/deployments?access_token="+GH_TOKEN,
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
  // var baseUrl = "https://api.github.com/?access_token=";
  var projectRepo = pathname.split('/');
  var forkNum = "https://ghbtns.com/github-btn.html?user=ibm-cds-labs&repo="+projectRepo[2]+"&type=fork&count=true&size=large"
  $('.fork-num').attr('src', forkNum);

  // $.ajax({
  //   method: "GET",
  //   url: baseUrl+token,
  //   dataType: "json"
  // });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/orgs/ibm-cds-labs/repos?sort=pushed&order=desc&access_token="+GH_TOKEN,
    dataType: "json",
    success: function(data) {
      for (var i = 0; i < 2 && i < data.length; i++) {
        var date = new Date(data[i].updated_at);
        var mm = date.getMonth() + 1;
        var dd = date.getDate();
        var yyyy = date.getFullYear();
        var cds_updated = mm + '/' + dd + '/' + yyyy;

        var li = $('<li></li>')
          .addClass('footer-github-repo')
          .appendTo('.footer-github > ul');

        $('<div></div>').addClass('project-name').text(data[i].name).appendTo(li);
        $('<div></div>').addClass('updated').html('Updated:&nbsp;<span class="repo-update">' + cds_updated + '</span>').appendTo(li);
        $('<div></div>').addClass('cds-snippet').text(data[i].description).appendTo(li);
      }
    }
  });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos"+a.pathname+"?access_token="+GH_TOKEN,
    dataType: "json",
    success: function(data){
      var issues = data.open_issues_count;
      var language = data.language;
      var forks = data.forks_count;
      var stars = data.stargazers_count;
      var watch = data.subscribers_count;
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
    url: "https://api.github.com/repos"+a.pathname+"/contributors"+"?access_token="+GH_TOKEN,
    dataType: "json",
    success: function(data){
       var contributors = data.length;
      $('.git-contributors').html(contributors);
    }
  });

  // $.ajax({
  //   method: "GET",
  //   url: "https://api.github.com/repos" +a.pathname + "/branches",
  //   dataType: "json",
  //   success: function(data){
  //      var branches = data.length;
  //     $('.git-branches').html(branches);
  //   }
  // });

  $.ajax({
    method: "GET",
    url: "https://api.github.com/repos" +a.pathname + "/pulls"+"?access_token="+GH_TOKEN,
    dataType: "json",
    success: function(data){
       var requests = data.length;
      $('.git-requests').html(requests);
    }
  });

  // $.ajax({
  //   method: "GET",
  //   url: "https://api.github.com/repos" +a.pathname + "/releases",
  //   dataType: "json",
  //   success: function(data){
  //      var releases = data.length;
  //     $('.git-releases').html(releases);
  //   }
  // });

}

$(document).ready(function(){
  getInfobox();
  listInfo();
});
