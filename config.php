<?php
$rss_links = array(
		array('name' => 'NowRunning', 
			  'link' => 'http://www.nowrunning.com/cgi-bin/rss/reviews_hindi.xml', 
			  'regex' => '([a-zA-Z0-9\s\.\,]+)',
		),
		array('name' => 'Indiatimes',
			  'link' => 'http://timesofindia.indiatimes.com/rssfeeds/2742919.cms', 
			  'regex' => '([a-zA-Z0-9\s\.\,]+)',
		),		
		array('name' => 'Bollywood world',
			  'link' => 'http://www.bollywoodworld.com/category/movie-reviews/feed', 
			  'regex' => '([a-zA-Z0-9\s\.\,]+)',
		),
);
define('CACHE_DIR', 'cache');
?>