<?php

//1. Add a new form element...
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {
    $mobile = ( ! empty( $_POST['mobile'] ) ) ? trim( $_POST['mobile'] ) : '';
    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
	$last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';
        
        ?>
		<p>
            <label for="mobile"><?php _e( 'Mobile No', 'mydomain' ) ?><br />
                <input type="number" name="mobile" id="mobile" class="input" value="<?php echo esc_attr( wp_unslash( $mobile ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>
		<p>
            <label for="first_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>
        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'mydomain' ) );
        }
		if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>ERROR</strong>: You must include a last name.', 'mydomain' ) );
        }
		if ( empty( $_POST['mobile'] ) || ! empty( $_POST['mobile'] ) && trim( $_POST['mobile'] ) == '' ) {
            $errors->add( 'mobile_error', __( '<strong>ERROR</strong>: You must include a Mobile No.', 'mydomain' ) );
        }

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
		if ( ! empty( $_POST['mobile'] ) ) {
            update_user_meta( $user_id, 'mobile', trim( $_POST['mobile'] ) );
        }
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
		if ( ! empty( $_POST['last_name'] ) ) {
            update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
        }
    }
	
	// extra fields display in admin dashboard
	add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>

<table class="form-table">
<tr>
<th><label for="address"><?php _e("Mobile No."); ?></label></th>
<td>
<input readonly type="number" name="mobile" id="mobile" value="<?php echo esc_attr( get_the_author_meta( 'mobile', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Mobile No. cannot be changed."); ?></span>
</td>
</tr>
<tr>
<th><label for="address"><?php _e("Address"); ?></label></th>
<td>
<input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your address."); ?></span>
</td>
</tr>
<tr>
<th><label for="city"><?php _e("City"); ?></label></th>
<td>
<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your city."); ?></span>
</td>
</tr>
<tr>
<th><label for="state"><?php _e("State"); ?></label></th>
<td>
<input type="text" name="state" id="state" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your state."); ?></span>
</td>
</tr>
<tr>
<th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
<td>
<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your postal code."); ?></span>
</td>
</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'address', $_POST['address'] );
update_user_meta( $user_id, 'city', $_POST['city'] );
update_user_meta( $user_id, 'province', $_POST['province'] );
update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}