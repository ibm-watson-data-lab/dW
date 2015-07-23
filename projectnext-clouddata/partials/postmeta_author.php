<?php
/**
 * Footer/meta information for post listings on Author Pages
 * Removes the avatar and author name, which will be the same for every item and is at the top of the page
 */
?>

<footer class="pn-post-meta links-std">
  <span class="pn-meta-date">
  <?php the_time(get_option('date_format')); ?>
  </span>
</footer>