<?php
/**
 * FolioPress Meta Boxes
 *
 * @package FolioPress
 */

/**
 * Add Meta Boxes only to page and posts
 *
 */
function foliopress_metabox() {
	add_meta_box(
		'foliopress-siderbar-layout',
		__( 'Below setting will not reflect on Grid Post View', 'foliopress' ),
		'foliopress_sidebar_layout'
	);
}
add_action( 'add_meta_boxes_page', 'foliopress_metabox' );
add_action( 'add_meta_boxes_post', 'foliopress_metabox' );

/**
 * Displays metabox to page and posts for sidebar layout
 */
function foliopress_sidebar_layout( $post ) {
	$sidebar_options = array(
	'default-sidebar' => array(
		'id'				=> 'foliopress_sidebarlayout',
		'value'			=> 'default',
		'label'			=> __( 'Default Layout set in Customizer', 'foliopress' ),
		),
	'no-sidebar'		=> array(
		'id'				=> 'foliopress_sidebarlayout',
		'value'			=> 'meta-nosidebar',
		'label' 			=> __( 'No Sidebar', 'foliopress' ),
		),
	'no-sidebar-full-width' => array(
		'id'    			=> 'foliopress_sidebarlayout',
		'value' 			=> 'meta-fullwidth',
		'label' 			=> __( 'No Sidebar, Full Width', 'foliopress' ),
		),
	'left-sidebar' 	=> array(
		'id'    			=> 'foliopress_sidebarlayout',
		'value' 			=> 'meta-left',
		'label' 			=> __( 'Left Sidebar', 'foliopress' ),
		),
	'right-sidebar' 	=> array(
		'id'    			=> 'foliopress_sidebarlayout',
		'value' 			=> 'meta-right',
		'label' 			=> __( 'Right Sidebar', 'foliopress' ),
		),
	);

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'foliopress_metabox_check' );

	// Begin the field table and loop  ?>
	<table id="sidebar-metabox" class="form-table" width="100%">
		<tbody>
			<tr>
				<?php foreach ( $sidebar_options as $field ) {
					$meta = get_post_meta( $post->ID, 'foliopress_sidebarlayout', true );
					if ( empty( $meta ) ) {
						$meta = 'default';
					} ?>
					<td>
						<label class="description">
							<input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_attr( $field['value'] ), $meta ); ?>/>
							<?php echo esc_attr( $field['label'] ); ?>
						</label>
					</td>
				<?php } // End foreach(). ?>
			</tr>
		</tbody>
	</table>
<?php
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function foliopress_save_custom_meta( $post_id, $post ) {

	// Verify the nonce before proceeding.
	if ( ! isset( $_POST['foliopress_metabox_check'] ) || ! wp_verify_nonce( $_POST['foliopress_metabox_check'], basename( __FILE__ ) ) ) {
		return;
	}

	// Stop WP from clearing custom fields on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// If user cannot edit posts/page we return.
	if ( ! current_user_can( 'edit_pages' )  || ! current_user_can( 'edit_posts' ) ) {
		return $post_id;
	}

	// Create a whitelist of accepted values.
	$options = array( 'default', 'meta-nosidebar', 'meta-right', 'meta-left', 'meta-fullwidth' );

	// We make sure there is something to save.
	if ( isset( $_POST['foliopress_sidebarlayout'] )
		&& ! empty( $_POST['foliopress_sidebarlayout'] )
		&& in_array( $_POST['foliopress_sidebarlayout'], $options, true ) ) {
		update_post_meta( $post_id, 'foliopress_sidebarlayout', $_POST['foliopress_sidebarlayout'] );
	}
}
add_action( 'save_post', 'foliopress_save_custom_meta', 10, 2 );
