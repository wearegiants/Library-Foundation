<?php 

  // Ticket + Book

  foreach($order->get_items() as $item) {
  $_product = get_product($item['product_id']);
  if ($item['product_id']==550) {?>
    
    You purchased a Book. Here's what's next. 

  <? }
}
?>



<?php 

  // Free RSVP

  foreach($order->get_items() as $item) {
  $_product = get_product($item['product_id']);
  if ($item['product_id']==542) {?>
    
    You RSVP'd for free. Here's what's next. 

  <? }
}
?>