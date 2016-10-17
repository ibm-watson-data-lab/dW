(function($) {
  // var GH_TOKEN = '290f1461867d4e60fb9f28b4574bac15dc0b5753';// '0fa278f898415de326b7925bdae042d58feb3ef2';
  var repoUrl = 'https://de352a73-71f2-46b5-a8ee-5f55f9b4c366-bluemix.cloudant.com/repoinfo/';
  var maxRepos = 3;

  //Ajax request to the Github API to load info about the showcases
  //Current request has a rate limit of 60 requests/hr per ip address
  function listInfo(){
    $('.showcase-item').each(function(){
      var url = $(this).find('.github-info').data('github');
      var a = $('<a>', {href:url})[0];
      var repoName = a.pathname.substr('ibm-cds-labs'.length+1);
      if (!repoName || repoName == 'undefined' || repoName.length < 3) return;

      var $this = $(this);
      $.ajax({
        method: 'GET', 
        url: repoUrl + repoName,
        dataType: 'json',
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

      // $.ajax({
      //   method: 'GET',
      //   url: 'https://api.github.com/repos'+a.pathname+'/deployments',
      //   dataType: 'json',
      //   success: function(data){
      //      var deployments = data.length;
      //     $this.find('.featured-deploys').html(deployments);
      //   }
      // });
    });
  }

  function getInfobox() {
    var url = $('.github-info').data('github');
    var a = $('<a>', {href:url})[0];
    var pathname = a.pathname;
    var projectRepo = pathname.split('/');
    var forkNum = 'https://ghbtns.com/github-btn.html?user=ibm-cds-labs&repo='+projectRepo[2]+'&type=fork&count=true&size=large'
    $('.fork-num').attr('src', forkNum);

    $.ajax({
      method: 'GET',
      url: 'https://de352a73-71f2-46b5-a8ee-5f55f9b4c366-bluemix.cloudant.com/repoinfo/_design/views/_view/chrono?reduce=false&include_docs=true&descending=true&limit=' + maxRepos, 
      dataType: 'json',
      success: function(data) {
        for (var i = 0; i < data.rows.length; i++) {
          var date = new Date(data.rows[i].doc.updated_at);
          var mm = date.getMonth() + 1;
          var dd = date.getDate();
          var yyyy = date.getFullYear();
          var cds_updated = mm + '/' + dd + '/' + yyyy;

          var li = $('<li></li>')
            .addClass('footer-github-repo')
            .appendTo('.footer-github > ul');

          var div = $('<div>', {class: 'project-name'});
          var html_url = data.rows[i].doc.html_url;
          var href = $('<a>', {
            text: data.rows[i].doc.name, 
            href: html_url
          }).appendTo(div);
          div.appendTo(li);
          // $('<div></div>').addClass('project-name').text(t).appendTo(li);
          $('<div></div>').addClass('updated').html('Updated:&nbsp;<span class="repo-update">' + cds_updated + '</span>').appendTo(li);
          $('<div></div>').addClass('cds-snippet').text(data.rows[i].doc.description).appendTo(li);
        }
      }
    });

    var repoName = a.pathname.substr('ibm-cds-labs'.length+1);
    if (!repoName || repoName == 'undefined' || repoName.length < 3) return;
    $.ajax({
      method: 'GET',
      url: repoUrl + repoName,
      dataType: 'json',
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

    // $.ajax({
    //   method: 'GET',
    //   url: 'https://api.github.com/repos'+a.pathname+'/contributors',
    //   dataType: 'json',
    //   success: function(data){
    //      var contributors = data.length;
    //     $('.git-contributors').html(contributors);
    //   }
    // });

    // $.ajax({
    //   method: 'GET',
    //   url: 'https://api.github.com/repos' +a.pathname + '/pulls',
    //   dataType: 'json',
    //   success: function(data){
    //      var requests = data.length;
    //     $('.git-requests').html(requests);
    //   }
    // });

    // $.ajax({
    //   method: 'GET',
    //   url: 'https://api.github.com/repos' +a.pathname + '/releases',
    //   dataType: 'json',
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
}(jQuery));
