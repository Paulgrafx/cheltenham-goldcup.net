<?php
$path = "../../assets/inline-adverts/".$_GET['ad'].".php";
$content = file_get_contents($path);
echo $content;
unset($content);
?>