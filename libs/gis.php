<?php

/***********************************************************************
* This program is free software: you can redistribute it and/or modify *
* it under the terms of the GNU General Public License as published by *
* the Free Software Foundation, either version 3 of the License, or    *
* (at your option) any later version.                                  *
*                                                                      *
* This program is distributed in the hope that it will be useful,      *
* but WITHOUT ANY WARRANTY; without even the implied warranty of       *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        *
* GNU General Public License for more details.                         *
*                                                                      *
* You should have received a copy of the GNU General Public License    *
* along with this program.  If not, see <http://www.gnu.org/licenses/> *
***********************************************************************/

// Image sizes
define ('GIS_LARGE', 'l');
define ('GIS_MEDIUM', 'm');
define ('GIS_ICON', 'i');
define ('GIS_ANY', '');

// Image types
define ('GIS_FACE', 'face');
define ('GIS_PHOTO', 'photo');
define ('GIS_CLIPART', 'clipart');
define ('GIS_LINEART', 'lineart');

function googleImageSearch ($query, $page = 1, $size = GIS_ANY, $type = GIS_ANY)
{

	$retVal = array();

	// Get the search results page
	$response = file_get_contents('http://images.google.com/images?hl=en&q=' . urlencode ($query) . '&imgsz=' . $size . '&imgtype=' . $type . '&start=' . (($page - 1) * 21));

	// Extract the image information. This is found inside of a javascript call to setResults
	preg_match('/\<table class=\"images_table\"(.*?)\>(.*?)\<\/table\>/is', $response, $match);
	
	if (isset($match[2])) {
		
		// Grab all the arrays
		preg_match_all('/\<td(.*?)\>(.*?)\<\/td\>/', $match[2], $m);
		
		foreach ($m[2] as $item) {
		
			// List of expressions used to grab all our info
			$info = array(
				'resultLink' => '\<a href=\"(.*?)\"',
				'source' => 'imgurl=(.*?)&amp;',
				'title' => '\<br\/\>(.*?)\<br\/\>([\d]+)',
				'width' => '([\d]+) &times;',
				'height' => '&times; ([\d]+)',
				'type' => '&nbsp;-([\w]+)',
				'size' => ' - ([\d]+)',
				'thumbsrc' => 'src="(.*?)"',
				'thumbwidth' => 'width="([\d]+)"',
				'thumbheight' => 'height="([\d]+)"',
				'domain' => '\<cite title="(.*?)"\>'
			);
			
			$t = new stdClass;
			$t->thumb = new stdClass;
			foreach ($info as $prop => $expr) {
				if (preg_match('/' . $expr . '/is', $item, $m)) {
					$value = 'title' == $prop ? str_replace(array('<b>', '</b>'), '', $m[1]) : $m[1];
					
					// Thumb properties go under the thumb object
					if (0 === strpos($prop, 'thumb')) {
						$prop = str_replace('thumb', '', $prop);
						$t->thumb->$prop = $value;
					} else {
						$t->$prop = $value;
					}
					
					// Nicey up the google images result url
					if ('resultLink' == 'resultLink') {
						$t->resultLink = 'http://images.google.com' . $t->resultLink;
					}
					
				}
			}
			
			$retVal[] = $t;

		}
		
	}
	
	return $retVal;
	
}