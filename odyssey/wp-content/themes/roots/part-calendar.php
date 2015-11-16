<section id="calendar" class="clearfix row">

	<div class="meta">
	<h2 class="section_title"><?php the_title(); ?></h2>
	<a class="rnd-button" href="<?php the_permalink(); ?>">View Full Calendar</a>
	</div>

	<?php if(get_field('events_listing_home')):  $i = 0; $counter = 1; ?>
	<?php while( has_sub_field('events_listing_home') ):  ?>

	<?php
		$image = get_sub_field('event_listing_image_home');
		$url = $image['url'];
		$title = $image['title'];
		$alt = $image['alt'];
		$caption = $image['caption'];
		$size = 'calendar-square';
		$size2 = 'calendar-square-alt';
		$thumb = $image['sizes'][ $size ];
		$thumbalt = $image['sizes'][ $size2 ];
	?>

	<?php if( get_sub_field('event_listing_featured_home') ) { ?>

	<div class="home-event <?php if($counter === 2) :  echo 'second col-md-6'; endif; ?><?php if($counter === 1) :  echo 'first col-md-6'; endif; ?><?php if($counter === 3) :  echo 'col-md-3'; endif; ?><?php if($counter === 4) :  echo 'col-md-3'; endif; ?>">
		<a class="event-link" target="blank" href="<?php the_sub_field('event_listing_link_home'); ?>"></a>
		<div class="meta">
			<h3 class="title"><a class="link" target="blank" href="<?php the_sub_field('event_listing_link_home'); ?>"><?php the_sub_field('event_listing_name_home'); ?></a></h3>
			<h3 class="sub-title"><span><?php the_sub_field('event_listing_datetime_text_home'); ?></span> | <?php the_sub_field('event_listing_location_home'); ?></h3>
		</div>
		<div class="mask"></div>

		<?php if($counter === 1) : ?><div class="thumb"><img class="img-responsive" alt="Library Foundation" src="<?php echo $thumb; ?>"></div> <?php endif; ?>

		<?php if($counter === 2) : ?><div class="thumb"><img class="img-responsive" alt="Library Foundation" src="<?php echo $thumbalt; ?>"></div> <?php endif; ?>

		<?php if($counter === 3) : ?><div class="thumb"><img class="img-responsive" alt="Library Foundation" src="<?php echo $thumb; ?>"></div> <?php endif; ?>

		<?php if($counter === 4) : ?><div class="thumb"><img class="img-responsive" alt="Library Foundation" src="<?php echo $thumb; ?>"></div> <?php endif; ?>

	</div>

	<?php $counter++; // add one per row ?>

	<?php } ?>
	<?php endwhile; ?>
	<?php endif; ?>
  <div class="col-md-12 text-center"><br>
 <p> <a href="/odyssey/local-libraries" class="event-btn-title">Throughout October, look for over 70 Odyssey-themed programs at your local Los Angeles Public Library branches!</a></p>
  <a href="/odyssey/local-libraries" class="rnd-button"> Check them out here</a>
  </div>

</section>

