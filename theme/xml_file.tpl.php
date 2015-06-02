<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<document>
  <?php 
    foreach($c['file'] as $key => $value) {
    	echo '<' . $key . '>';
    	echo $value;
    	echo '</' . $key . '>';
    }
  ?>
</document>