<?php
$newsFile = "../../../betting-directory/rss/racingNewsRSS.xml";
$news = transformRSS($newsFile);
echo "<div class=\"rightHeader\" style=\"margin-top:20px;\">Latest Racing News</div>\n".$news;
unset($news);
?>