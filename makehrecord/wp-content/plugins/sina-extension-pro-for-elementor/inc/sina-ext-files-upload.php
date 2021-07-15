<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Sina_Ext_Pro_Files_Upload Class for JSON files uploding functionality
 *
 * @since 1.6.0
 */
class Sina_Ext_Pro_Files_Upload{

  const MIME_TYPE = ['json' => 'application/json', 'svg' => 'image/svg+xml'];

  /**
   * Instance
   *
   * @since 1.6.0
   * @var Sina_Ext_Pro_Masker The single instance of the class.
   */
  private static $_instance = null;

  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded.
   *
   * @since 1.6.0
   * @return Sina_Ext_Pro_Masker An Instance of the class.
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Constructor.
   */
  public function __construct() {
    add_filter( 'upload_mimes', [$this, 'upload_mimes'] );
    add_filter( 'wp_handle_upload_prefilter', [$this, 'wp_handle_upload_prefilter'] );
    add_filter( 'wp_check_filetype_and_ext', [$this, 'wp_check_filetype_and_ext'], 10, 4 );
  }

  public function upload_mimes( $allowed_types ) {
    $allowed_types['json'] = self::MIME_TYPE['json'];
    $allowed_types['json'] = self::MIME_TYPE['svg'];
    return $allowed_types;
  }

  public function wp_handle_upload_prefilter( $file ) {
    if ( self::MIME_TYPE['json'] !== $file['type'] || self::MIME_TYPE['svg'] !== $file['type'] ) {
      return $file;
    }

    $ext = pathinfo( $file['name'], PATHINFO_EXTENSION );

    if ( 'json' !== $ext || 'svg' !== $ext ) {
      $file['error'] = sprintf(
        __( 'The uploaded %s file is not supported. Please upload a valid %s file', 'sina-ext-pro' ),
        $file['name'],
        $ext
      );
      return $file;
    }

    return $file;
  }

  public function wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
    if ( !empty( $data['ext'] ) && !empty( $data['type'] ) ) {
      return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );

    if ( 'json' === $filetype['ext'] || 'svg' === $filetype['ext'] ) {
      $data['ext'] = $filetype['ext'];
      $data['type'] = self::MIME_TYPE[ $filetype['ext'] ];
    }

    return $data;
  }
}