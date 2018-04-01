<?php
/**
 * Plugin Name: Wordpress Template Generic
 * Description: A generic base template for wordpress plugins
 * Version: 1.0
 * Author: Antonios D. Chasouras
 * License: Free
*/

//Insert any includes here


class wp_template{

    //Class variables here
    /** @var  $variable1 */
    private $variable1;


    function __construct() {

        $this->initialize();

        add_action( 'admin_menu', array( $this, 'add_menu_items' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'add_plugin_styles') );

        register_activation_hook( __FILE__, array( $this, 'on_activation' ) );
        register_deactivation_hook( __FILE__, array( $this, 'on_deactivation' ) );
    }

    /**
     * Create the menu in admin panel
     **/
    function add_menu_items() {

        add_menu_page( 'page.php', 'Wordpress plugin Template', 'manage_woocommerce', 'pslug', array(
            __CLASS__,
            'set_page_file_path'
        ), plugins_url('images/plugin_logo.png', __FILE__),'10');

        add_submenu_page( 'pslug', 'WP Template' . ' Page1', 'Page1', 'manage_options', 'mslug1', array(
            __CLASS__,
            'set_page_file_path'
        ));

        add_submenu_page( 'pslug', 'WP Template' . ' Page2', 'Page2', 'manage_options', 'mslug2', array(
            __CLASS__,
            'set_page_file_path'
        ));
    }

    /**
     * Initialize sequences here.
     */
    private function initialize(){
        //Do initialize staff such as setting values to class variables
        $this->variable1 = 1;
    }

    /**
     * Set pages content
     */
    static function set_page_file_path() {

        $screen = get_current_screen();

        if ( strpos( $screen->base, 'mslug1' ) !== false ) {

            include( dirname(__FILE__) . '/includes/page1.php' );
        } else if ( strpos( $screen->base, 'mslug2' ) !== false ){

            include( dirname(__FILE__) . '/includes/page2.php' );
        }

    }

    /**
     * Add styling for the plugin
     */
    public function add_plugin_styles( ) {

        wp_enqueue_style( 'wp_template_style', plugins_url('css/wp_template_style.css', __FILE__));
    }


    function on_activation() {
    }

    function on_deactivation() {
    }

}

/**
 * Generic ajax calls
 */
//No login
add_action( 'wp_ajax_nopriv_action-name', 'execute-action-name' );
//With login
add_action( 'wp_ajax_generate_action-name2', 'execute-action-name2' );

new wp_template();

?>