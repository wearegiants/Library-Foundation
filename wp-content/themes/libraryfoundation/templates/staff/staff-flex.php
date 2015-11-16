<?php

  if( have_rows('staff') ):

     echo '<div id="staff" class="row">';

    while ( have_rows('staff') ) : the_row();

      if( get_row_layout() == 'principal_group'):


        include('staff-principals.php');


      endif;

      if( get_row_layout() == 'staff_group'):


        include('staff-group.php');


      endif;

    endwhile;

     echo '</div>';

  endif;

?>