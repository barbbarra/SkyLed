<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name') ?></title>

	<?php get_template_part('_includes/iOS', 'icons') ?>
	<?php wp_head() ?>
</head>
<body>


	  <!--barra de navegación-->
	  <div class="navbar navbar-expand-lg navbar-light bg-light sticky-top pt-0 pl-5- pb-0">
	    <a class="navbar-brand p-0" href="#"><img class= "logo"src="<?php bloginfo('template_url') ?>/assets/img/logo-skyled.svg" alt="logo skyled"></a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php if ( has_nav_menu( 'header-menu' ) ) { ?>
					<?php wp_nav_menu( array(
															'container' => '',
															'theme_location' => 'header-menu',
															'menu_class' => 'navbar-nav mr-auto',

														) ); ?>
				<?php } ?>
	      <p class="font-weight-light text-success"><a href="/my-accound">login</a></p>
	    </div>
	  </div>
