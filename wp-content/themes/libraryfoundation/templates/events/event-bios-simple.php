<?php if( have_rows('more-people') ): ?>
<hr class="invisible">
<div id="event-bios-simple" class="row">
<?php while ( have_rows('more-people') ) : the_row(); $image = get_sub_field('other_photo'); ?>

<div class="item bio desktop-12 tablet-6 mobile-3">
  <div class="row">
    <div class="thumbnail desktop-3 tablet-1 mobile-3"><img class="rounded img-responsive" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
    <hr class="invisible desktop-hide tablet-hide mobile-3">
    <div class="meta desktop-9 tablet-5 mobile-3">
      <h3 class="title"><?php the_sub_field('other_name'); ?></h3>
      <?php the_sub_field('other_bio'); ?>
    </div>
  </div>
  <hr>
</div>


<?php endwhile; ?>
</div>
<?php endif;?>