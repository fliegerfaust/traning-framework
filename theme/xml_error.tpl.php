<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<error_document>

<error><?php echo $c['error_code'] . ' ' . $c['error_msg'] ?></error>

<?php 
if (!empty($c['error_messages'])) {
	foreach($c['error_messages'] as $msg) {
		echo '<error_message>' . $msg . '</error_message>';
	}
}
?>
</error_document>