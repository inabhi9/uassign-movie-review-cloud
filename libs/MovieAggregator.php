<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('lastRSS.php');
require_once('libs/gis.php');

class MovieAggregator{
	
	private $rss_links;
	private $movies;
	public $cache_dir;
	public $cache_time;
	private $cached_file = '/./movies.mrc';
	
	function __construct($rss_links){
		$this->rss_links = $rss_links;
	}
	
	private function init(){
		$rss = new lastRSS;
		$rss->cache_dir = $this->cache_dir;
		$rss->cache_time = $this->cache_time; // one hour
		
		foreach ($this->rss_links as $rss_links){
			$link = $rss_links['link'];
			$regex = $rss_links['regex'];
			$site_name = $rss_links['name'];
			
			$items = $rss->get($link); //Parsing
			$items = $items['items'];
			
			foreach ($items as &$item){
				//Generting id that should be unique to aggregate from various feed
				preg_match($regex, $item['title'], $match);
				$title = $match[0];
				$item['ntitle'] = $title;
				$item['from'] = $site_name;
				$item['link'] = str_replace(".comenter", ".com/enter", $item['link']);
				
				$image = explode('/', $item['link']);
				if (strpos(end($image), '.cms')){
					$image = 'http://timesofindia.indiatimes.com/photo/'.end($image);
					$item['image'] = $image;
				}
				
				$title = strtolower(preg_replace("[\W]", "", $title));
				$id = soundex($title);
				$item['id'] = $id;
				
				$image = $this->image($item['ntitle'], $id);
				
				if ($this->movies[$id] === null) $this->movies[$id] = array();
				array_push($this->movies[$id], array_merge($item, array('image'=>$image)));
			}
		}
		
		file_put_contents($this->cache_dir.$this->cached_file, json_encode($this->movies));
	}
	
	public function getMovies(){
		$file = $this->cache_dir.$this->cached_file;

		if (file_exists($file)){
			$filemtime = filemtime($file);
			if ((time() - $filemtime) > $this->cache_time)
				$this->clearCache();
		}
		
		if (file_exists($file)){
			return json_decode(file_get_contents($file), true);
		}
		else {
			$this->init();
			return $this->movies;
		}
	}
	
	public function clearCache(){
		unlink($this->cache_dir.$this->cached_file);
	}
	
	private function image($title, $id){
		$file = $this->cache_dir.'/images.cache';
		$images = array();
		
		if (file_exists($file)){
			$images = file_get_contents($file);
			$images = unserialize($images);
		}
		if ($images[$id] != null) return $images[$id];
		
		$img = googleImageSearch('"'.$title.'" bollywood movie', $page = 1, $size = GIS_MEDIUM);
		$img = $img[0]->source;
		
		$images[$id] = $img;
		file_put_contents($file, serialize($images));
		
		return $img;
	}
	
}
?>