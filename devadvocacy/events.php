<?php
/*
Template Name: Events Home Page
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/
$home = get_home_url();
?>

<?php get_header('devadv'); ?>

	<div id="content" class="content">
		<div class ="top-art">
			<div class="wrap">
				<div class="page-title">
		      <h1>Events</h1>
		      <hr>
		    </div>
	      <div class="event-filters">
	        <div class="filter-box">
	          <span class="filter-type">Region</span>
	          <div class="region-filter">
	            <span class="show-selected">Select</span>
							<img src="<?php bloginfo('template_url'); ?>/library/images/down-arrow.png" alt="down-arrow"/>
	            <ul class="dropdown">
								<?php
									$regions = array("North America"=>"NA", "Europe"=>"EU" );
									foreach($regions as $region =>$region_value):?>
								<li data-region="<?php echo $region_value?>" class="region-item"><?php echo $region ?></li>
								<?php endforeach; ?>
	            </ul>
	          </div>
	        </div>
	        <div class="filter-box">
	          <span class="filter-type">Date</span>
	          <div class="scope-filter">
	            <span class="show-selected">Select</span>
							<img src="<?php bloginfo('template_url'); ?>/library/images/down-arrow.png" alt="down-arrow"/>
	            <ul class="dropdown">
								<?php
									$events_period = array("3"=>"90", "6"=>"180");
									foreach($events_period as $period => $period_value):?>
								<li data-scope="<?php echo $period_value ?>"><?php echo $period. " months" ?></li>
								<?php endforeach; ?>
	            </ul>
	          </div>
	        </div>
				</div>
      </div>
		</div>
		<div id="inner-content events-list" class="wrap cf">
			<?php $events = EM_Events::get( array('scope' => 'future') );?>
			<!-- <div class="intro-text total-events"><span><?php echo count($events)?>&nbsp;</span>Events Found</div> -->
			<div class="intro-text total-events"><span></span>&nbsp;Events Found</div>
			<?php
			$event_region = array("NA"=>array("US", "CA"),
														"EU"=>array("GB","FR","DE","ES","RO","HU","AL",
																				 "AD","AM","AT","BY","BE","BA","BG",
																				 "CH","CY","CZ","DE","DK","EE","FO",
																				 "FI","GE","GI","GR","HR","IE","IS",
																				 "IT","LT","LU","LV","MC","MK","MT",
																				 "NO","NL","PO","PT","RU","SE","SI",
																				 "SK","SM","TR","UA","VA"));


				foreach($events as $EM_Event):setup_postdata($EM_Event);
					$name = $EM_Event->event_name;
					$location = $EM_Event->get_location()->location_name;
					$town = $EM_Event->get_location()->location_town;
					$state = $EM_Event->get_location()->location_state;
					$country = $EM_Event->get_location()->location_country;
					$date = $EM_Event->event_start_date;
					$scope_date = strtotime($date);
					$format_date = date("n/j/y", strtotime($date));
					$content = $EM_Event->post_content;
					$attributes = $EM_Event->event_attributes;
					//figure number of days between now and the event
					//used for date dropdown
					$now = time();
 		     	$datediff = $scope_date - $now;
 		     	$scope = ($datediff/(60*60*24));


				foreach($event_region as $region => $countries){
					if(in_array($country, $countries)){
						$region_code = $region;
					}}
			?>



			<div class="event-content clearfix" data-scope="<?php echo $scope?>" data-country="<?php echo $country?>" data-region="<?php echo $region_code?>">
				<div class="event clearfix">
					<div class="title"><?php echo $name; ?></div>
					<div class="location"><?php echo $location;?>, <?php echo $town;?>, <?php echo $state;?></div>
					<p><?php echo $content; ?></p>
          <a target="_blank" href="<?php echo $attributes["registration_link"];?>" class="project-btn">Register</a>
				</div>

				<aside class="clearfix">
					<div><?php echo $format_date; ?></div>

					<?php
						$user = unserialize($attributes['devadvocates']);
						$user_count = sizeof($user);
						if ($user[0] !== 'null'):
					?>
					<div>ATTENDING</div>
					<?php
						for ($i = 0; $i < $user_count; $i++) {
							$user_info = get_userdata($user[$i]);
					?>
					<div class="dev-attend">

            <div class="avatar"><?php echo get_avatar($user[$i]);?></div>

						<?php if ($user_info->user_firstname && $user_info->user_lastname): ?>
            	<div class="name"><a href="<?php echo $home?>/author/<?php echo $user_info->user_nicename?>"><?php echo $user_info->user_firstname; echo ('&nbsp;'); echo $user_info->user_lastname; ?></a></div>
						<?php elseif ($user_info->user_firstname): ?>
							<div class="name"><?php echo $user_info->user_firstname; ?></div>
						<?php else: ?>
							<div class="name"><?php echo $user_info->user_login; ?></div>
						<?php endif; ?>

          </div>
					<?php } ?>

					<?php endif; ?>

				</aside>

      </div>
		<?php endforeach; ?>


		</div>
	</div>


<?php get_footer(); ?>
