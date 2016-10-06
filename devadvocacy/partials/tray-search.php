<?php
  $home = get_home_url();
?>

<div class="tray-container search">
  <div class="search-area">
    <form id="search-form-tray" method="get">
      <input type="text" name="search">
      <button type="submit" class="project-btn">Search</button>
    </form>
    <div class="close clearfix"><a href="#"><img src="<?php bloginfo('template_url'); ?>/library/images/close-x.png" alt="close"/></a></div>
  </div>
  <div class="topics">
    <div class="topic-list" id="topic">
      <span class="topic-title">Topic</span>
      <ul></ul>
      <span><a href="<?php echo $home?>/how-tos" class="advanced">Advanced Search</a></span>
    </div>
    <div class="topic-list" id="language">
      <span class="topic-title">Language</span>
      <ul></ul>
    </div>
    <div class="topic-list" id="technology">
      <span class="topic-title">Technology</span>
      <ul></ul>
      <span>
        <a href="#" class="engine-info">Powered by the Simple Search Service</a>
        <a href="#" class="engine-info">i</a>
      </span>
      <div class="modal powered">
        <div class="arrow-up"></div>
        <div class="powered-info">
          <span>What's This?</span>
          <p>
            The most popular Topics, Technologies and Languages are determined
            by the Simple Search Service - a microservice that lets you quickly
            create a faceted search engine. See what else IBM can do for you.
          </p>
          <a href="<?php echo $home?>/simple-search-service"><p class="powered-cta">Learn More about the Simple Search Service</p></a>
        </div>
      </div>
    </div>
  </div>
</div>
