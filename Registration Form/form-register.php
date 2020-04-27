<form class="form-register form-ajax" action="ajax_register" method="post">
	<input type="text" name="first_name" class="first_name" placeholder="<?php _e( 'First Name', 'ystheme' ); ?>" required />
	<input type="text" name="last_name" class="last_name" placeholder="<?php _e( 'Last Name', 'ystheme' ); ?>" required />
	<input type="email" name="user_email" class="email" placeholder="<?php _e( 'Email', 'ystheme' ); ?>" required />
	<input type="password" class="password" name="password" placeholder="<?php _e( 'Password', 'ystheme' ); ?>" required />
	<input type="password" class="password_auth" name="password_auth" placeholder="<?php _e( 'Repeat Password', 'ystheme' ); ?>" required/>
	<input type="submit" class="btn-submit" value="<?php _e( 'Register', 'ystheme' ); ?>" />

	<div class="form-status"></div>
</form>
