<?php
// Parse args
list(
	'page_title' => $page_title,
	'page_description' => $page_description,
	'submenu_slug' => $submenu_slug,
) = $args;
?>
<div class="wrap">

	<h2><?php echo $page_title ?></h2>

	<?php
	// If there is a page description, display it.
	if (!empty($page_description)) {
		echo apply_filters('the_content', $page_description);
	}

	global $wp_settings_sections;

	if (array_key_exists($submenu_slug, $wp_settings_sections) && count($wp_settings_sections[$submenu_slug]) > 0) {
	?>
		<form method="POST" action="./options.php">

			<?php
			settings_fields($submenu_slug);
			do_settings_sections($submenu_slug);
			submit_button();
			?>

		</form>
	<?php
	}
	?>

</div>
