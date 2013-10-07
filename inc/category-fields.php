<?php
/**
 * Adds custom fields to categories
 *
 * 1. Image (URL)
 * 2. Icon classes
 */

class IPT_KB_Category_Fields {


	/*==========================================================================
	 * System API
	 *========================================================================*/

	public static function init() {
		$class = __CLASS__;
		return new $class();
	}

	/*==========================================================================
	 * Constructor
	 *========================================================================*/

	public function __construct() {
		if ( is_admin() ) {
			add_action( 'category_add_form_fields', array( $this, 'add_new_meta' ), 10, 2 );
			add_action( 'category_edit_form_fields', array( $this, 'edit_meta' ), 10, 2 );
			add_action( 'edited_category', array( $this, 'save_meta' ), 10, 2 );
			add_action( 'create_category', array( $this, 'save_meta' ), 10, 2 );
		}
	}

	/*==========================================================================
	 * Admin area meta fields and save
	 *========================================================================*/

	public function add_new_meta() {
		?>
<div class="form-field">
	<label for="term_meta_support_forum"><?php _e( 'Support Forum', 'ipt_kb' ) ?></label>
	<input type="text" name="term_meta[support_forum]" id="term_meta_support_forum" value="" class="regular-text code" />
	<p class="description"><?php _e( 'Link to support forum. For parent category only.', 'ipt_kb' ); ?></p>
</div>
<div class="form-field">
	<label for="term_meta_icon_class"><?php _e( 'Icon Class', 'ipt_kb' ) ?></label>
	<input type="text" name="term_meta[icon_class]" id="term_meta_icon_class" value="" class="regular-text code" />
	<p class="description"><?php _e( 'Add icon class to this category. This is for subcategories, not the parent category.', 'ipt_kb' ); ?></p>
</div>
<div class="form-field">
	<label for="term_meta_image_url"><?php _e( 'Image URL', 'ipt_kb' ) ?></label>
	<input type="text" name="term_meta[image_url]" id="term_meta_image_url" value="" class="regular-text code" />
	<p class="description"><?php _e( 'Add a 128X128 image for this category. Will only be used for parent categories.', 'ipt_kb' ); ?></p>
</div>
		<?php
	}

	public function edit_meta( $term ) {
		$item = get_option( 'ipt_kb_category_meta_' . $term->term_id, array() );
		?>
<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta_support_forum"><?php _e( 'Support Forum', 'ipt_kb' ) ?></label></th>
	<td>
		<input type="text" name="term_meta[support_forum]" id="term_meta_support_forum" value="<?php echo ( isset( $item['support_forum'] ) ? esc_attr( $item['support_forum'] ) : '' ); ?>" class="regular-text code" />
		<p class="description"><?php _e( 'Link to support forum. For parent category only.', 'ipt_kb' ); ?></p>
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta_icon_class"><?php _e( 'Icon Class', 'ipt_kb' ) ?></label></th>
	<td>
		<input type="text" name="term_meta[icon_class]" id="term_meta_icon_class" value="<?php echo ( isset( $item['icon_class'] ) ? esc_attr( $item['icon_class'] ) : '' ); ?>" class="regular-text code" />
		<p class="description"><?php _e( 'Add icon class to this category. This is for subcategories, not the parent category.', 'ipt_kb' ); ?></p>
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta_image_url"><?php _e( 'Image URL', 'ipt_kb' ) ?></label></th>
	<td>
		<input type="text" name="term_meta[image_url]" id="term_meta_image_url" value="<?php echo ( isset( $item['image_url'] ) ? esc_attr( $item['image_url'] ) : '' ); ?>" class="regular-text code" />
		<p class="description"><?php _e( 'Add a 128X128 image for this category. Will only be used for parent categories.', 'ipt_kb' ); ?></p>
	</td>
</tr>
		<?php
	}

	public function save_meta( $item_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$image_url = isset( $_POST['term_meta']['image_url'] ) ? stripslashes( $_POST['term_meta']['image_url'] ) : '';
			$icon_class = isset( $_POST['term_meta']['icon_class'] ) ? stripslashes( $_POST['term_meta']['icon_class'] ) : '';
			$support_forum = isset( $_POST['term_meta']['support_forum'] ) ? stripslashes( $_POST['term_meta']['support_forum'] ) : '';

			update_option( 'ipt_kb_category_meta_' . $item_id, array(
				'image_url' => $image_url,
				'icon_class' => $icon_class,
				'support_forum' => $support_forum,
			) );
		}
	}
}

IPT_KB_Category_Fields::init();
