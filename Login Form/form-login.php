<form class="form-login form-ajax" action="ajax_login" method="post">
	<input type="text" placeholder="<?php _e( 'Username', 'ystheme' ); ?>" name="username" id="username" />
	<input type="password" placeholder="<?php _e( 'Password', 'ystheme' ); ?>" name="password" id="password" />
	<input type="submit" class="btn-submit" value="<?php _e( 'Login', 'ystheme' ); ?>" />
	<input type="checkbox" name="remember" id="remember" />

	<label for="remember">
		<?php _e( 'Remember me', 'ystheme' ); ?>
	</label>

	<a href="<?php echo wp_lostpassword_url(); ?>" class="forgot_password blue">
		<?php _e( 'Forgot password?', 'ystheme' ); ?>
	</a>

	<div class="form-status"></div>
</form>
