<?php 
add_filter('more_taxonomies_saved', 'more_taxonomies_saved_subject');
function more_taxonomies_saved_subject ($d) {$d['subject'] = maybe_unserialize('a:15:{s:12:"hierarchical";s:1:"0";s:6:"public";s:0:"";s:5:"label";s:0:"";s:14:"singular_label";s:0:"";s:4:"name";s:0:"";s:7:"show_ui";s:1:"1";s:7:"rewrite";s:1:"0";s:12:"rewrite_base";s:8:"subjects";s:13:"show_tagcloud";s:1:"0";s:14:"query_var_bool";s:1:"1";s:9:"query_var";s:0:"";s:5:"index";s:7:"subject";s:12:"ancestor_key";s:0:"";s:11:"object_type";a:1:{i:0;s:7:"archive";}s:6:"labels";a:14:{s:4:"name";s:8:"Subjects";s:13:"singular_name";s:7:"Subject";s:12:"search_items";s:6:"Search";s:13:"popular_items";s:7:"Popular";s:9:"all_items";s:3:"All";s:11:"parent_item";s:6:"Parent";s:17:"parent_item_colon";s:6:"Parent";s:9:"edit_item";s:4:"Edit";s:11:"update_item";s:6:"Update";s:12:"add_new_item";s:7:"Add New";s:13:"new_item_name";s:8:"New Name";s:26:"separate_items_with_commas";s:20:"Separate with commas";s:19:"add_or_remove_items";s:13:"Add or Remove";s:21:"choose_from_most_used";s:34:"Choose from the most commonly used";}}', true); return $d; }
?>