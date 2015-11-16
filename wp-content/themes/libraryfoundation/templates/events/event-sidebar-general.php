<?php if( have_rows('sidebar_repeater') ): ?>

<div id="general-widgets">

<?php while ( have_rows('sidebar_repeater') ) : the_row(); ?>

<div class="widget">
<?php the_sub_field('sidebar_widget'); ?>
</div>

<?php endwhile; ?>

</div>

<?php endif; ?>

