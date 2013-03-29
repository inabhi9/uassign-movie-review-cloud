<?php include ('header.php'); ?>

<!-- MAIN WRAPPER -->
<div class="wrapper">
    <!-- Category Filter -->
    <div class="one">
        <div class="big-rounded-icon-white left margin15">
            <div class="icon-white-big icon170-white"></div>
        </div>
        <div class="left filter-title">
            <h2 class=" nobottommargin">Movies' List</h2>
            <ul id="filter">
                <li>Top Recent Movies</li>
            </ul>
        </div>
    </div>
    <div class="one margin15 separator"></div>
    <div class="one notopmargin on-light item" id="mlist">
        <?php 
			$cnt = 0; $max = 23;
            foreach($movies as $movie){
                $title = $movie[0]['ntitle'];
				$img = $movie[0]['image'];
                $id = $movie[0]['id'];
                $description = strip_tags(html_entity_decode($movie[0]['description']));
                $description = substr($description, 0, 75).'...';
                $html = '<div class="boxi photo col3">                            
                            <h3 style="overflow:hidden; padding:0px"><a href="review.php?id='.$id.'">'.$title.'</a></h3>
							<img style="max-width:210px;"  src="'.$img.'" alt=" "/>
							<p>'.$description.'</p>
							<a class="button_readmore"  href="review.php?id='.$id.'">Read review</a>
                        </div>';
                echo $html;
				$cnt++;
				if ($cnt > $max) break;
            }
        ?>
    </div>
    <div class="one separator margin45"></div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->

<script>
	 $('#mlist').imagesLoaded( function(){
	  $('#mlist').masonry({
		itemSelector : '.boxi'
	  });
	});
</script>
<?php include ('footer.php'); ?>