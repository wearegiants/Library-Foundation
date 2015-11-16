<?php Themewrangler::setup_page();get_header(); ?>
<?php get_template_part('templates/page', 'header-simple'); ?>

<div id="board-members" class="row">
  <div class="desktop-12 tablet-6 mobile-3">
    <?php if( have_rows('page_modules') ): while ( have_rows('page_modules') ) : the_row(); ?>



    <?php if( get_row_layout() == 'member_title'): ?>
    <header><h2><?php the_sub_field('title'); ?></h2></header>
    <?php endif; ?>

    <?php if( get_row_layout() == 'general_text_box'): ?>
    <div class="board">
    <?php the_sub_field('general_text_box'); ?>
    </div>
    <?php endif; ?>


    <?php endwhile; endif; ?>
  </div>
</div>

<?php get_footer(); ?>