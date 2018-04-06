<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
	<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'header_menu' ) ); ?>
<?php } ?>

<?php if (!is_home() || !is_front_page()) { ?>
	</div>
<?php } ?>

<?php wp_footer() ?>
</body>
</html>
