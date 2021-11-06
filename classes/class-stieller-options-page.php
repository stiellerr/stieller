<?php
/**
 * Stieller Options Page
 *
 * @link https://developer.wordpress.org/themes/functionality/widgets/
 *
 * @package Stieller
 */

if ( ! class_exists( 'Stieller_Options_Page' ) ) {

	/**
	 * Custom class used to implement the Page Excerpt widget.
	 */
	class Stieller_Options_Page {

		/**
		 * Sets up a new page excerpt widget instance.
		 */
		public function __construct() {
			write_log( 'Stieller_Options_Page' );
            
            
            if ( is_admin() ) {
				// Add the menu screen for inserting license information.
				add_action( 'admin_menu', array( &$this, 'add_menu' ) );
				add_action( 'admin_init', array( &$this, 'admin_init' ) );

				add_action( 'wp_ajax_download_data', array( &$this, 'download_data' ) ); // This is for authenticated users
				add_action( 'wp_ajax_nopriv_download_data', array( &$this, 'download_data' ) ); // This is for unauthenticated users.

				$this->options = get_option( 'stieller_options' );
			}
            
		}



		public function download_data() {
			
			write_log('zzz');
			
			$body = array(
				'url' => 'http://stieller.com'
			);
			
			$args = array(
				'method'      => 'POST',
				'headers' => array(
					"content-type"    => "application/json",
					//"x-rapidapi-host" => "host",
					//"x-rapidapi-key"  => "key"
				),
				'body' => json_encode($body)
			);

			
			
			$response = wp_remote_post(
				"https://cloudlayer-io.p.rapidapi.com/v1/url/pdf",
				$args
			);

			$upload = wp_upload_bits('zzz.pdf', null, $response['body']);

			write_log($upload);

			return;
			

			
			
			
			
			
			
			//https://github.com/mikehaertl/phpwkhtmltopdf
			$html = file_get_contents("https://stieller.com");

			write_log($html);
			// check ajax source is valid.
			check_admin_referer( 'stieller-options-options' );

			$html = file_get_contents("https://www.google.com");

			write_log($html);

			
			
			
			
			
			
			return;
			
			$args = array_filter(
				get_option( 'stieller_options' ),
				function( $key ) {
					if ( in_array( $key, array( 'key', 'place_id' ) ) ) {
						return true;
					}
				},
				ARRAY_FILTER_USE_KEY
			);
	
			// build url
			$request = add_query_arg(
				$args,
				'https://maps.googleapis.com/maps/api/place/details/json?fields=name%2Caddress_components%2Cformatted_address'
			);

			// send request.
			$response = wp_remote_get( $request );

			write_log( $response );
	
			if ( is_wp_error( $response ) ) {
				// Bail early
				wp_send_json_error( $response, 500 );
			}
	
			$body = wp_remote_retrieve_body( $response );

			$result = json_decode( $body )->result;

        }

        public function add_menu() {
			// add theme page.
			add_theme_page(
				__( 'Stieller', 'stieller' ),
				__( 'Stieller', 'stieller' ),
				'manage_options',
				'stieller-options',
				array( &$this, 'render_page' )
			);
		}

		// render page
        public function render_page() {

            // check user capabilities
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            ?>
            <div class="wrap">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <form action="options.php" method="post">
                    <?php
                    // output security fields for the registered setting "wporg"
                    settings_fields( 'stieller-options' );
                    // output setting sections and their fields
                    // (sections are registered for "wporg", each field is registered to a specific section)
                    do_settings_sections( 'stieller-options' );
                    // output save settings button
                    submit_button( 'Save Settings' );
                    ?>
                </form>
            </div>
            <?php
        }
        
		public function admin_init() {

			register_setting(
				'stieller-options',
				'stieller_options',
				array(
					'sanitize_callback' => array( &$this, 'sanitize_options' ),
				)
			);

			add_settings_section(
				'stieller_google',
				__( 'Google Settings', 'stieller' ),
				array( &$this, 'render_void' ),
				'stieller-options'
			);

			add_settings_field( 
				'key',
				__( 'API Key', 'stieller' ),
				array( &$this, 'render_input' ),
				'stieller-options',
				'stieller_google',
				array(
					'label_for' => 'stieller_options[key]',
					'id'        => 'key',
					'caption'	=> sprintf( '<p>Setup you api key <a href="%s" target="_blank">here.</a></p>', esc_url( 'https://developers.google.com/maps/documentation/places/web-service/get-api-key' ) )
				)
			);
	
			add_settings_field( 
				'place_id',
				__( 'Place ID', 'stieller' ),
				array( &$this, 'render_input' ),
				'stieller-options',
				'stieller_google',
				array(
					'label_for' => 'stieller_options[place_id]',
					'id'        => 'place_id',
					'caption'	=> sprintf( '<p>Find your place id <a href="%s" target="_blank">here.</a></p>', esc_url( 'https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder' ) ),
				)
			);

			add_settings_field( 
				'download',
				__( '&nbsp;', 'stieller' ),
				array( &$this, 'render_button' ),
				'stieller-options',
				'stieller_google',
				array(
					'id'      => 'download_data',
					'label'   => 'Download',
					'enabled' => $this->options && $this->options['place_id'] && $this->options['key']
				)
			);

			add_settings_field( 
				'name',
				__( 'Name', 'stieller' ),
				array( &$this, 'render_input' ),
				'stieller-options',
				'stieller_google',
				array(
					'label_for' => 'stieller_options[name]',
					'id'        => 'name',
					//'caption'	=> sprintf( '<p>Find your place id <a href="%s" target="_blank">here.</a></p>', esc_url( 'https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder' ) ),
					//'zzz'		=> 'ccc'
				)
			);

			add_settings_field( 
				'address',
				__( 'Address', 'stieller' ),
				array( &$this, 'render_textarea' ),
				'stieller-options',
				'stieller_google',
				array(
					'label_for' => 'stieller_options[address]',
					'id'        => 'address',
					//'caption'	=> sprintf( '<p>Find your place id <a href="%s" target="_blank">here.</a></p>', esc_url( 'https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder' ) ),
					//'zzz'		=> 'ccc'
				)
			);

			add_settings_field( 
				'tagline',
				__( 'Tagline', 'stieller' ),
				array( &$this, 'render_textarea' ),
				'stieller-options',
				'stieller_google',
				array(
					'label_for' => 'stieller_options[tagline]',
					'id'        => 'tagline',
				)
			);

			add_settings_field( 
				'build',
				__( '&nbsp;', 'stieller' ),
				array( &$this, 'render_button' ),
				'stieller-options',
				'stieller_google',
				array(
					'id' => 'build',
					'label' => 'Build Page',
				)
			);
		}

		// render input
        public function render_void( $args ) {
            return false;
        }
    
        // render button
        public function render_button( $args ) {
			printf( 
				'<input type="button" id="%1$s" value="%2$s" class="button button-secondary" %3$s>',
				esc_attr( $args['id'] ),
				esc_attr( $args['label'] ),
				esc_attr( $args['enabled'] ) ? '' : 'disabled'
			);
        }
    
        // render input
        public function render_input( $args ) {

			write_log( $args );

            printf( 
                '<input type="text" id="stieller_options[%1$s]" name="stieller_options[%1$s]" value="%2$s" class="regular-text">',
                esc_attr( $args['id'] ),
                $this->options ? esc_attr( $this->options[ $args['id'] ] ) : ''
            );
            echo isset( $args['caption'] ) ? $args['caption'] : '';
        }

		// render textarea
		public function render_textarea( $args ) {
			printf( 
				'<textarea id="zthemename_options[%1$s]" name="zthemename_options[%1$s]" class="regular-text" rows="5" disabled>%2$s</textarea>',
				esc_attr( $args['id'] ),
				$this->options ? esc_attr( $this->options[ $args['id'] ] ) : ''
			);
		}

        public function sanitize_options( $data ) {

			foreach ( $data as $key => $value ) {
				$data[ $key ] = sanitize_text_field( $value );
			}
			
            return $data;
		}
    }

    new Stieller_Options_Page();
}