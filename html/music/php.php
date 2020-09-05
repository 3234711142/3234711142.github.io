<?php
$resullt = file_get_contents("/html/music/php2.php?name=".$_GET["name"]."&number=".$_GET["number"]);
echo $resullt;
?>