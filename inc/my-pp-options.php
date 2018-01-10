<?php
add_action( 'admin_menu', 'mypp_add_admin_menu' );
add_action( 'admin_init', 'mypp_settings_init' );


function mypp_add_admin_menu(  ) { 

	add_menu_page( 'My prettyPhoto', 'My prettyPhoto', 'manage_options', 'my_prettyphoto', 'mypp_options_page' );

}


function mypp_settings_init(  ) { 

	register_setting( 'pluginPage', 'mypp_settings' );

	add_settings_section(
		'mypp_pluginPage_section', 
		__( '', 'mypp' ), 
		'', 
		'pluginPage'
	);

	add_settings_field( 
		'mypp_select_pp_theme', 
		__( 'prettyPhoto theme', 'mypp' ), 
		'mypp_select_pp_theme_render', 
		'pluginPage', 
		'mypp_pluginPage_section' 
	);


}


function mypp_select_pp_theme_render(  ) { 

	$options = get_option( 'mypp_settings' );
	?>
	<select name='mypp_settings[mypp_select_pp_theme]'>
		<option value='pp_default' <?php selected( $options['mypp_select_pp_theme'], 'pp_default' ); ?>>pp_default</option>
		<option value='light_rounded' <?php selected( $options['mypp_select_pp_theme'], 'light_rounded' ); ?>>light_rounded</option>
		<option value='dark_rounded' <?php selected( $options['mypp_select_pp_theme'], 'dark_rounded' ); ?>>dark_rounded</option>
		<option value='light_square' <?php selected( $options['mypp_select_pp_theme'], 'light_square' ); ?>>light_square</option>
		<option value='dark_square' <?php selected( $options['mypp_select_pp_theme'], 'dark_square' ); ?>>dark_square</option>
		<option value='facebook' <?php selected( $options['mypp_select_pp_theme'], 'facebook' ); ?>>facebook</option>
	</select>
<?php

}

function mypp_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>My prettyPhoto</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php
}

?>