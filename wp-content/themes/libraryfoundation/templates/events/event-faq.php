<?php global $post; $terms = get_the_terms($post->ID, 'tribe_events_cat'); if( !empty($terms) ) { $term = array_pop($terms); ?>

<?php if ( have_rows('faq', $term ) || have_rows('frequently_asked_questions') ): ?>

<div id="faq" class="accordion page-section">
<div class="row">
<div class="desktop-8 tablet-6 mobile-3">
<h3 class="event-section-title">Frequently Asked Questions</h3>
<ul id="faq-accordion">

<?php while ( have_rows('frequently_asked_questions') ) : the_row(); ?>
  <li class="item">
    <a href="#tab" class="title"><?php the_sub_field('question'); ?></a>
    <div><?php the_sub_field('answer'); ?></div>
  </li>
<?php endwhile; ?>

<?php if ( !get_field('faq_options') ): ?>
<?php if( have_rows('faq', $term ) ): ?>


<?php while ( have_rows('faq', $term ) ) : the_row(); ?>
  <li class="hello item">
    <a href="#tab" class="title"><?php the_sub_field('question'); ?></a>
    <div><?php the_sub_field('answer'); ?></div>
  </li>
<?php endwhile;?>


<?php endif; ?>
<?php endif; ?>


<?php endif; } ?>

</ul>
</div>
</div>
</div>