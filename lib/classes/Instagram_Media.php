<?php

namespace Harbinger_Marketing;

use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;

class Instagram_Media {

	const ADMIN_NOTICE_TRANSIENT_NAME = 'ínstagram_admin_notice';
	const MEDIA_TRANSIENT_NAME = 'ínstagram_media';
	const REFRESH_ACCESS_TOKEN_HOOK = 'refresh_access_token';

	protected static $instance = null;

	protected $instagram_basic_display;

	protected $app_id;
	protected $app_secret;
	protected $access_token;
	protected $redirect_uri;

	protected function __construct( $app_id, $app_secret, $access_token = '' ) {
		if ( !in_array( 'administrator', wp_get_current_user()->roles ) ) {
			return;
		}
		
		$this->app_id = $app_id;
		$this->app_secret = $app_secret;
		$this->access_token = $access_token;
		$this->redirect_uri = get_bloginfo('url') . '/instagram/authorize/';

		$this->init_instagram_basic_display_object();

		$this->add_hooks();
		$this->add_cronjobs();
    }

	public static function init( $app_id, $app_secret, $access_token = '' ) {
		if ( !self::$instance ) {
			self::$instance = new self( $app_id, $app_secret, $access_token );
		}

		return self::$instance;
	}

	public static function get_instance() {
		return self::$instance;
	}

	protected function init_instagram_basic_display_object() {
		$this->instagram_basic_display = new InstagramBasicDisplay(
			array(
				'appId' => $this->app_id,
				'appSecret' => $this->app_secret,
				'redirectUri' => $this->redirect_uri
			)
		);

		if ( $this->access_token ) {
			$this->instagram_basic_display->setAccessToken( $this->access_token );
		}
	}
	
	protected function add_hooks() {
		add_filter( 'generate_rewrite_rules', array( $this, 'add_rewrite_rules' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		
		add_action( 'admin_init', array( $this, 'process_admin_notices' ) );

		if ( !$this->access_token ) {
			add_action( 'admin_bar_menu', array( $this, 'add_authorize_instagram_account_button_to_admin_bar' ), 100 );
			add_action( 'wp', array( $this , 'process_authorization' ) );
		} else {
			add_action( self::REFRESH_ACCESS_TOKEN_HOOK, array( $this, 'refresh_access_token' ) );
		}
	}

	public function add_authorize_instagram_account_button_to_admin_bar( $admin_bar ) {
		$admin_bar->add_menu(
			array(
				'id'    => 'authorize-instagram',
				'title' => __('Authorize Instagram Account', THEME_TEXTDOMAIN),
				'href'  => $this->instagram_basic_display->getLoginUrl()
			)
		);
	}

	public function add_rewrite_rules( $wp_rewrite ) {
		$wp_rewrite->rules = array_merge(
			array(
				'instagram/authorize/?' => 'index.php?action=authorize-instagram'
			),
			$wp_rewrite->rules
		);

		if ( get_current_screen()->base != 'options-permalink' ) {
			flush_rewrite_rules();
		}
	}

	public function add_query_vars( $query_vars ) {
		$query_vars[] = 'action';
		
		return $query_vars;
	}

	protected function add_cronjobs() {
		if ( !$this->access_token ) {
			return;
		}

		if ( !wp_get_scheduled_event( self::REFRESH_ACCESS_TOKEN_HOOK ) ) {
			wp_schedule_event( strtotime('+7 days'), 'weekly', self::REFRESH_ACCESS_TOKEN_HOOK );
		}
	}

	public function process_authorization() {
		if ( get_query_var('action') != 'authorize-instagram' || empty( $_GET['code'] ) ) {
			return;
		}
	
		$code = $_GET['code'];
	
		$token = $this->instagram_basic_display->getOAuthToken( $code, true );
		$token = $this->instagram_basic_display->getLongLivedToken( $token, true );
	
		if ( !$token ) {
			set_transient(
				self::ADMIN_NOTICE_TRANSIENT_NAME,
				array(
					'type' => 'error',
					'message' => __('The Instagram authorization failed. Please verify your app credentials or try again later.', THEME_TEXTDOMAIN)
				),
				60
			);
		} else {
			carbon_set_theme_option( 'instagram_access_token', $token );
	
			set_transient(
				self::ADMIN_NOTICE_TRANSIENT_NAME,
				array(
					'type' => 'success',
					'message' => __('Successful Instagram authorization! Your access token has been set.', THEME_TEXTDOMAIN)
				),
				60
			);
		}
	
		wp_redirect( get_admin_url() );
	
		exit;
	}

	public function process_admin_notices() {
		$instagram_admin_notice = get_transient( self::ADMIN_NOTICE_TRANSIENT_NAME );

		if ( !$instagram_admin_notice ) return;
	
		add_action(
			'admin_notices',
			function() use ( $instagram_admin_notice ) {
				?>
					<div class="notice notice-<?php echo $instagram_admin_notice['type'] ?> is-dismissible">
						<p>
							<?php echo $instagram_admin_notice['message'] ?>
						</p>
					</div>
				<?php
			}
		);
	
		delete_transient( self::ADMIN_NOTICE_TRANSIENT_NAME );
	}

	public static function get() {
		return self::get_instance()->get_media();
	}

	public function get_media() {
		$media = get_transient( self::MEDIA_TRANSIENT_NAME );

		if ( !$media ) {
			return $this->refresh_media();
		}

		return $media;
	}

	protected function refresh_media() {
		$media = $this->instagram_basic_display->getUserMedia();

		set_transient( self::MEDIA_TRANSIENT_NAME, $media, DAY_IN_SECONDS );

		return $media;
	}

	public function refresh_access_token() {
		$refreshed_access_token = $this->instagram_basic_display->refreshToken( $this->access_token, true );
		
		if ( $refreshed_access_token ) {
			carbon_set_theme_option( 'instagram_access_token', $refreshed_access_token );
		}
	}

}
