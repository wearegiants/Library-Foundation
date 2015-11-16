<?php

// Convert to Pending

//function to print publish button
function show_pending_button(){
global $wp_query;
$thePostID = $wp_query->post->ID;
//only print fi admin
if (current_user_can('publish_posts')){
echo '

<form action="" method="POST" name="front_end_publish"><input id="pid" type="hidden" name="pid" value="'.$thePostID.'" />
<input id="FE_PUBLISH" type="hidden" name="FE_PUBLISH" value="FE_PUBLISH" />
<input id="submit" class="button green" type="submit" name="submit" value="Publish" /></form>';
}
}

//function to update post status
function change_post_status($post_id,$status){
$current_post = get_post( $post_id, 'ARRAY_A' );
$current_post['post_status'] = $status;
wp_update_post($current_post);
}

if (isset($_POST['FE_PUBLISH']) && $_POST['FE_PUBLISH'] == 'FE_PUBLISH'){
if (isset($_POST['pid']) && !empty($_POST['pid'])){
change_post_status((int)$_POST['pid'],'publish');
}
}


?>