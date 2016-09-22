<?php
/*
* Template Name: Search Results Page
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header('devadv'); ?>


<div id="is-search-results-page"></div>
<div id="content" class="search content">
  <div class="top-art clearfix">
		<div class="wrap">
	    <div class="search-tool">

	      <form id="search-cloudant" method="get">
	        <input type="text" name="search">
	        <button type="submit" class="project-btn">Search</button>
	      </form>

	      <div class= "query_selections"></div>
	    </div>

	    <div class="search-filters">
	      <div class="filter-box">
	        <div class="filter">
	          <span>Add Topic</span>
            <span><img src="<?php bloginfo('template_url'); ?>/library/images/down-arrow.png" alt="down-arrow"/></span>
	          <ul class="dropdown topic"></ul>
	        </div>
	      </div>

	      <div class="filter-box">
	        <div class="filter">
	          <span>Add Language</span>
            <span><img src="<?php bloginfo('template_url'); ?>/library/images/down-arrow.png" alt="down-arrow"/></span>
	          <ul class="dropdown language"></ul>
	        </div>
	      </div>

	      <div class="filter-box">
	        <div class="filter">
	          <span>Add Technology</span>
            <span><img src="<?php bloginfo('template_url'); ?>/library/images/down-arrow.png" alt="down-arrow"/></span>
	          <ul class="dropdown technology"></ul>
	        </div>
	      </div>
	    </div>
		</div>
  </div>

  <div id="inner-content" class="wrap cf">
    <div class="intro-text total-count"><span>0</span>&nbsp;Search results</div>
    <hr>
    <div class="results-content clearfix"></div>
  </div>
</div>

<?php get_footer(); ?>
