<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Music and Such</title>
	 <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php  $isLogged = is_user_logged_in() ? true : false ; ?>

<?php
wp_nav_menu( array( 
    'theme_location' => 'top-nav', 
	'container_class' => 'nav-menu' ) 
); 
?>
