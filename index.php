<?php
/*
Plugin Name: Chuck Norris Jokes Plugin
Plugin URI: https://api.chucknorris.io/
Description: Plugin that prints on screen a Chuck Norris joke every 5 seconds
Version: 1.0.0
Author: Alberto Privado Moreno
Author URI: http://www.google.es
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function wp_plugin_enqueue_scripts() {
    wp_enqueue_script('chuck_script', plugin_dir_url(__FILE__) .'/index.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'wp_plugin_enqueue_scripts' );

class Category {
	private $category_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'category_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'category_page_init' ) );
	}

	public function category_add_plugin_page() {
		add_menu_page(
			'Chuck Norris jokes settings',
			'Chuck Norris jokes settings',
			'manage_options',
			'category',
			array( $this, 'category_create_admin_page' ),
			'dashicons-admin-network',
		);
	}

	public function category_create_admin_page() {
		$this->category_options = get_option( 'category_option_name' ); ?>

		<div class="wrap">
			<h2>Chuck Norris jokes settings</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'category_option_group' );
					do_settings_sections( 'category-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function category_page_init() {
		register_setting(
			'category_option_group',
			'category_option_name',
			array( $this, 'category_sanitize' )
		);

		add_settings_section(
			'category_setting_section',
			'Settings',
			array( $this, 'category_section_info' ),
			'category-admin'
		);

		add_settings_field(
			'category_0',
			'Category',
			array( $this, 'category_0_callback' ),
			'category-admin',
			'category_setting_section'
		);
	}

	public function category_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['category_0'] ) ) {
			$sanitary_values['category_0'] = $input['category_0'];
		}

		return $sanitary_values;
	}

	public function category_section_info() {
		
	}

	public function category_0_callback() {
		?> <select name="category_option_name[category_0]" id="category_0">
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '') ? 'selected' : '' ; ?>
			<option value="" <?php echo $selected; ?>>Random</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=animal') ? 'selected' : '' ; ?>
			<option value="?category=animal" <?php echo $selected; ?>>Animal</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=career') ? 'selected' : '' ; ?>
			<option value="?category=career" <?php echo $selected; ?>>Career</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=celebrity') ? 'selected' : '' ; ?>
			<option value="?category=celebrity" <?php echo $selected; ?>>Celebrity</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=dev') ? 'selected' : '' ; ?>
			<option value="?category=dev" <?php echo $selected; ?>>Dev</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=explicit') ? 'selected' : '' ; ?>
			<option value="?category=explicit" <?php echo $selected; ?>>Explicit</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=fashion') ? 'selected' : '' ; ?>
			<option value="?category=fashion" <?php echo $selected; ?>>Fashion</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=food') ? 'selected' : '' ; ?>
			<option value="?category=food" <?php echo $selected; ?>>Food</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=history') ? 'selected' : '' ; ?>
			<option value="?category=history" <?php echo $selected; ?>>History</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=money') ? 'selected' : '' ; ?>
			<option value="?category=money" <?php echo $selected; ?>>Money</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=movie') ? 'selected' : '' ; ?>
			<option value="?category=movie" <?php echo $selected; ?>>Movie</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=music') ? 'selected' : '' ; ?>
			<option value="?category=music" <?php echo $selected; ?>>Music</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=political') ? 'selected' : '' ; ?>
			<option value="?category=political" <?php echo $selected; ?>>Political</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=religion') ? 'selected' : '' ; ?>
			<option value="?category=religion" <?php echo $selected; ?>>Religion</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=science') ? 'selected' : '' ; ?>
			<option value="?category=science" <?php echo $selected; ?>>Science</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=sport') ? 'selected' : '' ; ?>
			<option value="?category=sport" <?php echo $selected; ?>>Sport</option>
			<?php $selected = (isset( $this->category_options['category_0'] ) && $this->category_options['category_0'] === '?category=travel') ? 'selected' : '' ; ?>
			<option value="?category=travel" <?php echo $selected; ?>>Travel</option>
		</select> <?php
	}

}
if ( is_admin() )
	$category = new Category();

function get_chuck_joke() {
	$response='';
	$response2='';
	$url = 'https://api.chucknorris.io/jokes/random';
	$category_options = get_option( 'category_option_name' );
	$category_0 = $category_options['category_0'];
	$completeUrl = $url . $category_0;
	?>
	<script>
	var completeUrl = '<?php echo $completeUrl; ?>';
		setInterval(function(){ 
			jQuery.ajax({
				url: completeUrl,
				success: function(response){
					document.getElementsByClassName("entry-content")[0].append(response['value']);
					document.getElementsByClassName("entry-content")[0].innerHTML += "<br>";
				},
				error: function(){
					console.log("Error");
				}
			});
		}, 5000);
	</script>
	<?php
}
?>
	
	<?php

add_shortcode( 'get_chuck', 'get_chuck_joke' );
