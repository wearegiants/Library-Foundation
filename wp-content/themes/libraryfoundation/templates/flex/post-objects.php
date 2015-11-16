<?php

if( have_rows('references') ):

    while ( have_rows('references') ) : the_row();

        $post_object = get_sub_field('page');
        $post = $post_object;
        setup_postdata( $post );

        get_template_part('templates/membership', 'level' );

        wp_reset_postdata();

    endwhile;

endif;

?>