<?php 
	include ('header.php');
	$id = $_GET['id'];
	if ($movies[$id] === null)
		die('<center><h1>No such movie found</h1></center>');
		
	
?>
<!-- MAIN WRAPPER -->
<div class="wrapper">
    <div class="two-third on-light">
        <div class="notopmargin" style="clear:both; overflow:hidden">
            <div style="float:right"><a href="index.php" class="button_readmore">Go Back</a></div>
            <h2 class="margin15"><?php echo $movies[$id][0]['ntitle'] ?></h2>
            <p class="margin10"><strong>Total <?php echo count($movies[$id]) ?> reviews found. Check that out!</strong></p>
        </div>
        
        <?php 
            foreach($movies[$id] as $review){
                $html = '<div class="last margin20 cms">
                            <div class="small-round-icon-white left">
                                <div class="icon-white-small icon12-white">
                                    <a href="index.html"><img src="images/1px.png" alt="" width="24px" height="24px" /></a>
                                </div>
                            </div>
                            <h3 class="margin15">'.$review['title'].' - '.$review['from'].'</h3>
                            <p class="margin15">'.strip_tags(html_entity_decode($review['description'])).'</p>
                            <p><a class="btn grey"  href="'.$review['link'].'" target="_blank">Read more</a></p>
                        </div>
                        <div class="notopmargin last dot-separator"></div>';
                echo $html;
            }
        ?>
    </div> 
    <div class="one-third sidebar1-3 last">
    	<div class="spec-border-ie" rel="prettyPhoto">
            <img class="img-preview spec-border"  src="<?php echo $movies[$id][0]['image'] ?>" alt=" " width="210px"/>
        </div>
    </div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
</div>
<?php include('footer.php') ?>