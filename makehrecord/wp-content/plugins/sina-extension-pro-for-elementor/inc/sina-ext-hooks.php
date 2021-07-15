<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Hooks Class for all widgets related hook functions
 *
 * @since 1.0.0
 */
Class Sina_Ext_Pro_Hooks{
	public static function ajax_register() {
		if ( check_ajax_referer( 'sina_register', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_register' ) ) {

			$email 			= sanitize_email( $_POST['email'] );
			$uname 			= sanitize_text_field( $_POST['uname'] );
			$is_captcha		= sanitize_text_field( $_POST['is_captcha'] );
			$captcha		= sanitize_text_field( $_POST['captcha'] );
			$err = '';

			if ( '' == $email) {
				$err = esc_html__( 'Invalid email!', 'sina-ext-pro' );
			} elseif ( email_exists( $email ) ) {
				$err = esc_html__( 'Oops! Email already exists!', 'sina-ext-pro' );
			}

			if ( '' == $err ) {
				if ( '' == $uname) {
					$err = esc_html__( 'Username can\'t be empty!', 'sina-ext-pro' );
				} elseif ( strlen($uname) < 3 ) {
					$err = esc_html__( 'Username too short! Must be contain 3-32 characters.', 'sina-ext-pro' );
				} elseif ( strlen($uname) > 32 ) {
					$err = esc_html__( 'Username too long! Must be contain 3-32 characters.', 'sina-ext-pro' );
				} elseif ( username_exists( $uname ) ) {
					$err = esc_html__( 'Username already exists!', 'sina-ext-pro' );
				} elseif ( preg_match("/^[a-zA-Z][ a-zA-Z0-9]{2,31}$/", $uname) ) {
					$uname = $uname;
				} else {
					$err = esc_html__( 'Special character(s) not allowed in your username!', 'sina-ext-pro' );
				}
			}

			if ( '' == $err && 'true' == $is_captcha ) {
				$secret_key = get_option( 'sina_ext_pro_recaptcha_secret_key' );
				$url 		= 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key .'&response='. $captcha;
				$response 	= wp_remote_get( $url );
				$data 		= json_decode( wp_remote_retrieve_body( $response ), true );

				if ( !$data["success"] ) {
					$err = esc_html__( 'Invalid reCAPTCHA!', 'sina-ext-pro' );
				}
			}

			if ( '' == $err ) {
				$user_id = wp_create_user( $uname, '', $email );
				if ( $user_id ) {
					wp_new_user_notification( $user_id, null, 'user' );
					$err = 'success';
				} else{
					$err = esc_html__('Internal error!', 'sina-ext-pro');
				}
			}

			printf( '%s', $err );
		}
		die();
	}
	public static function ajax_lost_password() {
		if ( check_ajax_referer( 'sina_lost_pass', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_lost_pass' ) ) {

			$email = sanitize_email( $_POST['email'] );
			$err = '';

			if ( '' == $email) {
				$err = esc_html__( 'Invalid email!', 'sina-ext-pro' );
			} elseif ( email_exists( $email ) ) {
				$user_data 	= get_user_by( 'email', $email );
				$user_login = $user_data->user_login;
				$user_email = $user_data->user_email;
				$key 		= get_password_reset_key( $user_data );

				if ( is_wp_error( $key ) ) {
					$err = esc_html__( 'Internal Error!', 'sina-ext-pro' );
				}

				if ( is_multisite() ) {
					$site_name = get_network()->site_name;
				} else {
					$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
				}

				$message = esc_html__( 'Someone has requested a password reset for the following account:', 'sina-ext-pro' ) . "\r\n\r\n";
				/* translators: %s: Site name. */
				$message .= sprintf( __( 'Site Name: %s', 'sina-ext-pro' ), $site_name ) . "\r\n\r\n";
				/* translators: %s: User login. */
				$message .= sprintf( __( 'Username: %s', 'sina-ext-pro' ), $user_login ) . "\r\n\r\n";
				$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.', 'sina-ext-pro' ) . "\r\n\r\n";
				$message .= esc_html__( 'To reset your password, visit the following address:', 'sina-ext-pro' ) . "\r\n\r\n";
				$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

				$title = sprintf( __( '[%s] Password Reset', 'sina-ext-pro' ), $site_name );
				$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
				$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

				$from_text = sanitize_text_field( $_POST['from_text'] );
				$site_name = get_bloginfo( 'name' );
				$site_name = $from_text ? $from_text : $site_name;
				$admin_email = get_option('admin_email');
				$headers = 'From: '. $site_name .' <'. $admin_email .'>';

				if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message, $headers ) ) {
					$err = esc_html__( 'The email could not be sent. This site may not be correctly configured to send emails.', 'sina-ext-pro' );
				} elseif ('' == $err) {
					$err = 'success';
				}
			} else{
				$err = esc_html__( 'Oops! Email not exists!', 'sina-ext-pro' );
			}

			printf( '%s', $err );
		}
		die();
	}
	public static function instant_search(){
		if ( check_ajax_referer( 'sina_instant_search', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_instant_search' ) ) {

			$data = sanitize_text_field( $_POST['search_info'] );
			$data = json_decode(stripslashes($data), true);
			$default = [
				'post_type'		=> $data['posts'],
				'posts_per_page'=> -1,
				'post_status'	=> 'publish',
				'has_password'	=> false,
				's'				=> esc_attr( $_POST['keyword'] ),
			];

			$search_query = new WP_Query($default);

			if( $search_query->have_posts() ) :
				while( $search_query->have_posts() ): $search_query->the_post(); ?>
					<a class="sina-pro-search-item clearfix" href="<?php echo esc_url( post_permalink() ); ?>">
						<?php if ($data['is_thumb'] == 'yes' && has_post_thumbnail()): ?>
							<div class="sina-pro-inst-search-thumb">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
						<?php endif; ?>
						<div class="sina-pro-inst-search-content">
							<?php the_title();?>
						</div>
					</a>
				<?php endwhile;
			else:
				printf('<div class="sina-pro-search-item">%s</div>', esc_html__( 'Not found', 'sina-ext-pro' ));
			endif;
			wp_reset_query();
		}
		die();
	}
	public static function ajax_posts_on_scroll() {
		if ( check_ajax_referer( 'sina_on_scroll_posts', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_on_scroll_posts' ) ) {

			$offset = sanitize_text_field( $_POST['offset'] );
			$data = sanitize_text_field( $_POST['posts_data'] );
			$data = json_decode(stripslashes($data), true);
			$txt_len = (int) $data['content_length'];

			$default = [
				'category__in'		=> $data['categories'],
				'tag__in'			=> $data['tags'],
				'orderby'			=> [ $data['order_by'] => $data['sort'] ],
				'posts_per_page'	=> (int) $data['posts_num'],
				'offset'			=> (int) $offset,
				'has_password'		=> false,
				'post_status'		=> 'publish',
				'post__not_in'		=> get_option( 'sticky_posts' ),
			];

			// Post Query
			$post_query = new WP_Query( $default );

			if ( $post_query->have_posts() ) {
				?>
				<div class="sina-ajax-posts">
					<?php if ( in_array($data['layout'], ['grid', 'list', 'thumb']) ): ?>
						<?php include SINA_EXT_PRO_LAYOUT.'/posts/'.$data['layout'].'.php'; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</div>
				<?php
			}
		}
		die();
	}
}