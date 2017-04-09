<?php

	// get images from directory
	$imgDir = 'images/Cigar_Events/'.$_GET['imgDir'];
	$bm_pages = array();
	
	$dirHandle = opendir($imgDir);
	while($file = readdir($dirHandle)){
        if ( $file != 'Thumbs.db' && $file != "." && $file != ".." ) {
			$bm_pages[] = $imgDir."/".$file;
		}
	}
	closedir($dirHandle);
	
	$i = 1;
	$last_page = count($bm_pages);

?>

	<div class="div-Cigar-Events" >
		<?PHP foreach( $bm_pages as $key => $value ){; ?>
			<Left><img src="<?PHP echo $bm_pages[$key] ?>" width="722" height="1100 " /></Left>
			<br>
			<?php if(  $i < $last_page ) { ?>
				<span class="red-bar">Page <?php echo $i ?> - Please go to the top right column on this page &amp; read it first before continuing to the next page below</span>
			<?PHP $i++; } ?>
		<?PHP } ?>
		<br />
		<center><a class="adlinks" href="/nav-to-page.php?subNav=3&outputMess=Cigar Events&content=Cigar_Events.php" target="_self">Back to BLUE MASS page</a></center>

	</div>


	<!--
		<br>	<span class="red-bar">Page 2</span>
		<div class="div-blue-mass-2"><a class="adlinks" href="bluemass.php" target="_self">Back to BLUE MASS page</a></div>
	-->
