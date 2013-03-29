<?php
set_time_limit(0);
include ('config.php');
include ('libs/MovieAggregator.php');

$movies = new MovieAggregator($rss_links);
$movies->cache_dir = CACHE_DIR;
$movies->cache_time = 900; //15mins
$movies = $movies->getMovies();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title>Movie Review Cloud</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@-moz-document url-prefix()
{
.spec-border, .flickr {border: 1px solid #4c4f55 !important;}
.on-light .spec-border {border: 1px solid #dedede !important;}
.sidebar1-3 .flickr {border: 1px solid #dedede !important;}
}
</style>
<!--[if IE]>
<link href="css/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="css/colorpicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/nivo-default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/masonry.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.masonry.min.js"></script>

<script type="text/javascript">
	var sukablyadIE=false;
</script>
<!–[if IE]>
	<script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
    <script type="text/javascript">
        var sukablyadIE=true;
        DD_roundies.addRule('.spec-border-ie', '14px');
    </script>
<![endif]–>

<link href='http://fonts.googleapis.com/css?family=Shanti' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Crimson+Text:regular,regularitalic,600,600italic,bold,bolditalic' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Crushed' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Puritan' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Allerta' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Kreon' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Radley' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Bentham' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css' />
<!--GOOGLE FONTS-->
</head>

<body>

<div class="top-inner ondark">
    <div class="wrapper">
        <div class="one-half">
            <a href="index.php" title=""><img src="images/logo-footer.png" alt="Angry Drop" /></a>
        </div>
        <div class="one-half last">
            <h1 class="welcome">Movie Review Cloud</h1>
        </div>
    </div>
</div>