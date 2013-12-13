<?php
/*
Plugin Name: Pco Image Widget Field
Plugin URI: http://peytz.dk/medarbejdere/
Description: An easy way to add an image field to your custom build widget.
Version: 1.0
Author: Peytz (Patrick Hesselberg & James Bonham)
Author URI: http://peytz.dk/medarbejdere/
*/

function _pcoiw_e( $text ) {
	_e( $text, 'pco-iwf' );
}

function _pcoiw__( $text ) {
	return __( $text, 'pco-iwf' );
}

function pco_image_field( $obj, $instance, $settings = array() ) {
	$defaults = array(
		'title'       => _pcoiw__( 'Image' ),
		'update'      => _pcoiw__( 'Update Image' ),
		'field'       => 'image_id',
	);

	$settings = wp_parse_args( $settings, $defaults );
	extract( $settings );

	$instance[$field] = !empty( $instance[$field] ) ? $instance[$field] : '';
	$image = wp_get_attachment_image_src( $instance[$field], 'medium' );
	$src = !empty( $image ) ? current( $image ) : '';
	?>
	<div style="text-align:center;border:2px dashed #ddd;padding:10px;">
		<?php $image_id = $obj->get_field_id( $field ); ?>

		<div class="pco-image" id="pco-image-<?php echo $image_id; ?>" style="overflow:hidden">
			<div class="newimage-section">
				<input type="button" class="button pco-image-select" style="width:100%;height:36px;" value="<?php _pcoiw_e( 'Select image' ); ?>" data-title="<?php echo $title; ?>" data-update="<?php echo $update; ?>" data-target="<?php echo $image_id; ?>" />
				<input type="hidden" class="pco-image-id" name="<?php echo $obj->get_field_name( $field ); ?>" id="<?php echo $image_id; ?>">
			</div>
			<div class="image-section" style="display:none">
				<div style="text-align:center;">
					<img src="<?php echo $src ?>" alt="<?php echo $image; ?>" />
				</div>
				<div style="margin-top:5px;text-align:left;">
					<input type="hidden" name="<?php echo $obj->get_field_name( $field ); ?>" id="<?php echo $image_id; ?>" class="pco-image-id" value="<?php echo $instance[$field]; ?>">
					<input type="button" class="button pco-image-select" data-title="<?php echo $title; ?>" data-update="<?php echo $update; ?>" data-target="<?php echo $image_id; ?>" value="<?php _pcoiw_e( 'Edit/change' ); ?>" />
					<input type="button" class="button pco-image-remove" value="<?php _pcoiw_e( 'Remove' ); ?>" data-target="<?php echo $image_id; ?>" />
				</div>
			</div>
		</div>
	</div>
	<?php
}

class Pco_Image_Widget_Field {
	static public $PLUGIN_URL;
	static public $PLUGIN_DIR;

	function __construct() {
		$this->define_vars();
		$this->hooks();
	}

	function define_vars() {
		self::$PLUGIN_URL = DIV_FEATURES_URL.'/fields/image-widget-field/';
		self::$PLUGIN_DIR = DIV_FEATURES_DIR.'/fields/image-widget-field/';
	}

	function hooks() {
		add_action( 'plugins_loaded', array( &$this, 'i18n' ) );
		add_action( 'admin_init', array( &$this, 'register_script' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );
	}

	function i18n() {
		load_plugin_textdomain( 'pco-iwf', false, basename( self::$PLUGIN_DIR ) . '/languages/' );
	}

	function admin_scripts( $hook_suffix ) {
		if ( 'widgets.php' == $hook_suffix ) {
			wp_enqueue_media();
			wp_enqueue_script( 'image-widget-field' );
		}
	}

	function register_script() {
		wp_register_script( 'image-widget-field', self::$PLUGIN_URL . 'js/image-widget-field.js', array( 'media-upload', 'media-views' ) );
	}
}

if( is_admin() )
	new Pco_Image_Widget_Field();

