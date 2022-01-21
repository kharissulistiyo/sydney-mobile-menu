<?php
/**
 * Sydney Mobile Menu
 *
 * @package     Sydney Mobile Menu
 * @author      kharisblank
 * @copyright   2020 kharisblank
 * @license     GPL-2.0+
 *
 * @sydney-mobile-menu
 * Plugin Name: Sydney Mobile Menu
 * Plugin URI:  https://easyfixwp.com/
 * Description: Add simpler mobile menu on all screen sizes to Sydney theme.
 * Version:     0.0.1
 * Author:      kharisblank
 * Author URI:  https://easyfixwp.com
 * Text Domain: sydney-mobile-menu
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Disallow direct access to file
defined( 'ABSPATH' ) or die( __('Not Authorized!', 'sydney-mobile-menu') );

function sydney_mobmenu2_is_sydney_active() {

  $theme  = wp_get_theme();
  $parent = wp_get_theme()->parent();

  if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
   return false;
  }

  return true;

}


/**
 * Enqueue Sydney Scripts.
 */
function sydney_mobmenu2_enqueue_scripts() {
  
    $is_sydney = sydney_mobmenu2_is_sydney_active();
    
    if( !$is_sydney ) {
      return;
    }
  
    wp_enqueue_style( 'slicknav', plugins_url( '/css/slicknav.css', __FILE__ ) );
    wp_enqueue_style( 'sydney-mobile-menu', plugins_url( '/css/sydney-mobile-menu.css', __FILE__ ) );
    wp_enqueue_script( 'jquery.slicknav', plugins_url( '/js/jquery.slicknav.min.js', __FILE__ ), array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'sydney_mobmenu2_enqueue_scripts' );

/**
 * Active Slicknav Menu.
 */
function paira_active_menu_scripts() {
  
  $is_sydney = sydney_mobmenu2_is_sydney_active();
  
  if( !$is_sydney ) {
    return;
  }  

  ?>
  <script type="text/javascript">
  
      jQuery(window).scroll(function() {    
          var scroll = jQuery(window).scrollTop();

          if (scroll >= 3) {
              jQuery('body').addClass("body-sydney-scrolling");
          } else {
              jQuery('body').removeClass("body-sydney-scrolling");
          }
      });  
  
      jQuery(document).ready(function ($) {

          $('#primary-menu').slicknav({
              label: '',
              // prependTo: '.main-header',
              openedSymbol: '<i class="fa fa-minus-circle"></i>',
              closedSymbol: '<i class="fa fa-plus-circle"></i>',
              removeClasses: true,
              allowParentLinks: true,
              closeOnClick:'true',
          });

      });
  </script>
  <?php
}

add_action( 'wp_footer', 'paira_active_menu_scripts' );