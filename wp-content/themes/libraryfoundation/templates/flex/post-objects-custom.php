<?php

if( have_rows('references') ):

    while ( have_rows('references') ) : the_row();

        if (is_page('membership')) {

          get_template_part('templates/membership', 'level-custom' );

        } else {

          get_template_part('templates/membership', 'level-custom' );
                    
        }

    endwhile;

endif;

?>