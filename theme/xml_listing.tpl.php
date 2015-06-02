<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<xml_listing>
  <?php 
    foreach($c['filelist'] as $filename) {
    	echo '<filename>';
    	echo $filename;
    	echo '</filename>';
    }
  ?>
</xml_listing>