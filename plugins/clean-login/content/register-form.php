<div class="cleanlogin-container cleanlogin-full-width">
	<form class="cleanlogin-form" method="post" action="#">
		<fieldset>
			<?php /*check if 'Name and surname' is checked */ if ( get_option( 'cl_nameandsurname' ) == 'on' ) : ?>
				<div class="cleanlogin-field">
					<input class="cleanlogin-field-name" type="text" name="first_name" value="" placeholder="<?php echo __( 'First name', 'cleanlogin' ); ?>">
				</div>
				<div class="cleanlogin-field">
					<input class="cleanlogin-field-surname" type="text" name="last_name" value="" placeholder="<?php echo __( 'Last name', 'cleanlogin' ); ?>">
				</div>
			<?php endif; ?>
			
			<?php /*check if email as username is checked */ if ( get_option( 'cl_email_username' ) != 'on' ) : ?>
				<div class="cleanlogin-field">
					<input class="cleanlogin-field-username" type="text" name="username" value="" placeholder="<?php echo __( 'Username', 'cleanlogin' ); ?>">
				</div>
			<?php endif; ?>
			
			<div class="cleanlogin-field">
				<input class="cleanlogin-field-email" type="email" name="email" value="" placeholder="<?php echo __( 'E-mail', 'cleanlogin' ); ?>">
			</div>
			<div class="cleanlogin-field">
				
				<input type='number' name='mobile' placeholder="Mobile No." value=" ">
			</div>

			<div class="cleanlogin-field-website">
				<label for='website'>Website</label>
				<input type='text' name='website' value=" ">
			</div>
			
			<div class="cleanlogin-field">
				<input class="cleanlogin-field-password" type="password" name="pass1" value="" autocomplete="off" placeholder="<?php echo __( 'New password', 'cleanlogin' ); ?>">
			</div>
			
			<?php /*check if single password is checked */ if ( get_option( 'cl_single_password' ) != 'on' ) : ?>
				<div class="cleanlogin-field">
					<input class="cleanlogin-field-password" type="password" name="pass2" value="" autocomplete="off" placeholder="<?php echo __( 'Confirm password', 'cleanlogin' ); ?>">
				</div>
			<?php endif; ?>

			<?php /*check if captcha is checked */ if ( get_option( 'cl_antispam' ) == 'on' ) : ?>
				<div class="cleanlogin-field">
					<img src="<?php echo plugins_url( 'captcha', __FILE__ ); ?>"/>
					<input class="cleanlogin-field-spam" type="text" name="captcha" value="" autocomplete="off" placeholder="<?php echo __( 'Type the text above', 'cleanlogin' ); ?>">
				</div>
			<?php endif; ?>
			

			<?php /*check if custom roles is checked */ if ( get_option( 'cl_chooserole' ) == 'on' ) : ?>
				<?php if ($param['role']) : ?>
				<input type="text" name="role" value="<?php echo $param['role']; ?>" hidden >
				<?php else : ?> 
				<div class="cleanlogin-field cleanlogin-field-role" <?php if ( get_option( 'cl_antispam' ) == 'on' ) echo 'style="margin-top: 46px;"'; ?> >
					<span><?php echo __( 'Choose your role:', 'cleanlogin' ); ?></span>
					<select name="role" id="role">
						<?php
						$newuserroles = get_option ( 'cl_newuserroles' );
						global $wp_roles;
						foreach($newuserroles as $role){
							echo '<option value="'.$role.'">'. translate_user_role( $wp_roles->roles[ $role ]['name'] ) .'</option>';
						}
						?>
					</select>
				</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php /*check if termsconditions is checked */ if ( get_option( 'cl_termsconditions' ) == 'on' ) : ?>
				<div class="cleanlogin-field">
					<label class="cleanlogin-terms">
						<input name="termsconditions" type="checkbox" id="termsconditions">
						<a href="<?php echo get_translated_option_page( 'cl_termsconditionsURL' ); ?>" target="_blank"><?php echo get_option( 'cl_termsconditionsMSG' ); ?></a>
					</label>
				</div>
			<?php endif; ?>

		</fieldset>

		<div>	
			<input type="submit" id='buttonActivate' value="<?php echo __( 'Register', 'cleanlogin' ); ?>" name="submit" >
			<input type="hidden" name="action" value="register">		
		</div>

	</form>
</div>
<script>
var ajax_url_customer = '<?php echo admin_url( 'admin-ajax.php' ); ?>';

function verify_mobile_customer() {
    var e = jQuery("input[name=mobile]").val();
    jQuery.ajax({
        type: "GET",
        url: ajax_url_customer,
        data: {
            action: "unbook",
            mobile: e
        },
        success: function(r) {
        console.log(r);
           // if ("sent" == r) {
              if(1){
                var t = prompt("Enter OTP sent to your mobile");
                t ? jQuery.get(ajax_url_customer, {
                    action: "unbook_verify",
                    mobile: e,
                    otp_pin: t
                }).done(function(e) {
                    "true" == e ? (console.info("Number Verified!"), jQuery("form").unbind("submit"), jQuery("#buttonActivate").html("Register").attr("disabled", !1).trigger("click")) : (console.error("Wrong OTP"), jQuery("#buttonActivate").html("Register").attr("disabled", !1))
                }) : (console.warn("No OTP ENTERED!!!!!!"), jQuery("#buttonActivate").html("Register").attr("disabled", !1))
            }
        }
    })
}
jQuery("form").bind("submit", function() {
    return (jQuery("#buttonActivate").html("working..").attr("disabled", !0), verify_mobile_customer()), !1
});

</script>  
