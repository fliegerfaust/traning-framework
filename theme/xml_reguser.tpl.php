<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<user>
  <?php 
    echo '<login>' . $c['user']['login'] . '</login>';
    echo '<password>' . $c['user']['pass'] . '</password>';
  ?>
</user>